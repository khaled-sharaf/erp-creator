import moment from 'moment'

export default {
    data() {
        return {
            rangeDateDays: [],
            rangeDateMonths: [],
            successResponse: false,
            dataTable: [],
            sortOrders: {},
            showSettings: false,
            viewColumnsResponsive: {},

            viewTableClasses: [
                "dark",
                "bordered",
                "borderless",
                "sm",
                // "responsive",
                // "light",
                // "hover",
                // "striped",
            ],
            perPage: [5, 10, 15, 20, 25, 50, 100, 200, 300, 500],
            pagination: {
                currentPage: 0,
                firstPageUrl: '',
                from: 0,
                lastPage: '',
                lastPageUrl: '',
                nextPageUrl: '',
                path: '',
                perPage: 0,
                prevPageUrl: '',
                to: 0,
                total: 0,
            },

            tableData: {
                draw: 0,
                length: 15,
                sortBy: 'id',
                // filters
                trashed: 1,
                active: "",
                display: "",
                rule: "",
                search: "",
                from_date: "",
                to_date: "",
                // ./filters

                searchColumnSelected: ['all'],
                dir: "desc",
                columns: [],
                searchColumns: ['all'],
                filter: {
                    viewTable: ['sm', 'striped'],
                    columnsExcept: ['index', 'actions', 'image', 'photo'],
                },
                countItemsSelected: 0
            },
        }
    },
    
    watch: {
        "tableData.from_date"(val) {
            this.getData()
        },
        "tableData.to_date"(val) {
            this.getData()
        },
        "tableData.columns.length"(val) {
            const self = this
            let btnShowPlus = $(`#${self.idPage}.dataTable .btn-show-more-row`)
            if (this.columnsExcept.length) {
                btnShowPlus.removeClass('disabled')
            } else {
                $(".tr-table-data").hide()
                btnShowPlus.removeClass("active").find("i").removeClass("fa-minus").addClass("fa-plus")
                btnShowPlus.addClass('disabled')
            }
            $(".tr-table-data").children("td").attr("colspan", val + 2)
            $(".table tbody tr.tr-general").each(function() {
                let id = $(this).attr("data-id")
                $(this).next(".tr-table-data").find("td").html(self.viewDataExcepted(id))
            })
        },
    },

    computed: {
        columnsExcept() {
            return this.columns.filter(column => {
                const name = column.name
                return this.tableData.columns.indexOf(name) == -1 && name != 'select_row' && name != 'show_plus' && name != 'index'
            }).map(column => column.name)
        },
    },

    methods: {
        getData(url = this.urlGetDataTable) {
            loadReq(this.$Progress)
            this.successResponse = false
            this.tableData.draw++
            axios.get(url, {params: this.tableData}).then(response => {
                let data = response.data

                data.data.data.forEach(element => {
                    let booking_date = element.booking_date;
                    let renewal_date = element.renewal_date;
                    let firstDate = moment(booking_date, 'YYYY-MM-DD');
                    let secondDate = moment(renewal_date, 'YYYY-MM-DD');
                    let duration = moment.duration(secondDate.diff(firstDate));
                    this.rangeDateDays.push(duration._data.days)
                    // let months = duration._data.months / 2629746000;
                    var months = duration.asMonths();
                    this.rangeDateMonths.push(Math.round(months));
                });
                
                if (typeof data === 'object') {
                    if (this.tableData.draw == data.draw) {
                        if (response.status === 200) {
                            this.dataTable = data.data.data
                            this.successResponse = true
                            this.configPagination(data.data)
                            setTimeout(() => {
                                this.updateRowDataWhenGet()
                            })
                        }
                    }
                } else {
                    setTimeout(() => {
                        this.getData()
                    }, 500)
                    this.$Progress.fail()
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    if (errors.response && errors.response.status && errors.response.status != 404) {
                        this.getData()
                    }
                }, 500)
                this.$Progress.fail()
            })
        },

        gotopage(value) {
            console.log(this.urlGetDataTable, value)
            this.getData(this.urlGetDataTable + "?page=" + value)
        },
        // get data
        configPagination(data) {
            this.pagination.currentPage = data.current_page
            this.pagination.firstPageUrl = data.first_page_url
            this.pagination.from = data.from
            this.pagination.lastPage = data.last_page
            this.pagination.lastPageUrl = data.last_page_url
            this.pagination.nextPageUrl = data.next_page_url
            this.pagination.path = data.path
            this.pagination.perPage = data.per_page
            this.pagination.prevPageUrl = data.prev_page_url
            this.pagination.to = data.to
            this.pagination.total = data.total
        },

        sortBy(key) {
            this.tableData.sortBy = key
            this.sortOrders[key] = this.sortOrders[key] * -1
            this.tableData.dir = this.sortOrders[key] == 1 ? "asc" : "desc"
            this.getData()
        },

        getIndex(array, key, value) {
            return array.findIndex(i => i[key] == value)
        },

        setViewColumnsResponsive() {
            const getSetting = setInterval(() => {
                const settings = {...JSON.parse(localStorage.getItem(this.$nameSettingsInDB))}
                const settingModel = settings[this.idPage]
                if (settingModel) {
                    clearInterval(getSetting)
                    settingModel.filter(screen => {
                        return screen.active
                    }).forEach(screen => {
                        this.viewColumnsResponsive[screen.screenSize] = screen.showColumns
                    })
                }
            }, 200)
        },

        viewFilterColumns() {
            let defaultColumns
            const allScreenSizes = []
            const getScreenObject = setInterval(() => {
                this.setViewColumnsResponsive()
                if (this.viewColumnsResponsive.default) {
                    clearInterval(getScreenObject)
                    let obj = this.viewColumnsResponsive


                    defaultColumns = obj.default
                    this.tableData.columns = defaultColumns

                    for (let screenNumber in obj) {
                        if (screenNumber != "default") {
                            if (!isNaN(screenNumber % 1)) {
                                screenNumber = parseInt(screenNumber)
                                allScreenSizes.push(screenNumber)
                            }
                        }
                    }
                    let maxMedia = Math.max(...allScreenSizes),
                        minMedia = Math.min(...allScreenSizes)
                    for (let size in allScreenSizes) {
                        size = parseInt(size)
                        let keyMediaNumber = allScreenSizes[size] + 0.02 // +1px in width screen
                        let numPx = ""
                        if (allScreenSizes.length != size + 1) {
                            numPx = window.matchMedia(`(max-width: ${allScreenSizes[size + 1]}px) and (min-width: ${keyMediaNumber}px)`)
                        } else {
                            numPx = window.matchMedia("(max-width: " + minMedia + "px)")
                        }
                        let bigSizeMedia = window.matchMedia(`(min-width: ${maxMedia + 0.02}px)`)
                        if (numPx.matches) {
                            let currentScreen = typeof allScreenSizes[size + 1] != "undefined" ? allScreenSizes[size + 1] : minMedia
                            this.tableData.columns = obj[currentScreen]
                        } else if (bigSizeMedia.matches) {
                            this.tableData.columns = defaultColumns
                        }
                    }
                }
            }, 200)
        },

        viewDataExcepted(id) {
            let list = ""
            id = parseInt(id)
            for (let col in this.dataTable) {
                if (this.dataTable[col].id == id) {
                    list = "<ul>"
                    for (let columnName in this.columnsExcept) {
                        let colName = this.columnsExcept[columnName]
                        for (let colNative in this.columns) {
                            if (this.columns[colNative].name == colName) {
                                let colLabel = this.columns[colNative].label
                                list += `<li> <span class="label"> ${colLabel}</span> ${$( ".table tbody tr[data-id='" + id + "'] td." + this.columnsExcept[columnName]).html()} </li>`
                            }
                        }
                    }
                    list += "</ul>"
                }
            }
            return list
        },

        updateRowDataWhenGet() {
            const self = this
            $(`#${this.idPage}.dataTable tbody tr.tr-table-data`).each(function() {
                $(this).remove()
            })

            $(`#${this.idPage}.dataTable tbody tr.tr-general .select_row,
                #${this.idPage}.dataTable tbody tr.tr-general .show_plus`).each(function() {
                $(this).remove()
            })

            setTimeout(() => {
                $(".table tbody tr.tr-general").each(function(index) {
                    let id = $(this).attr("data-id")
                    let selectRowHTML = ''
                    if (!self.hideMultiSelect) {
                        selectRowHTML = `
                        <td class="td-checkbox select_row">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" value="${id}" class="checkbox-input custom-control-input" id="select_row_${index}">
                                <label class="custom-control-label" for="select_row_${index}"></label>
                            </div>
                        </td>`
                    }
                    $(this).prepend(` ${selectRowHTML}
                        <td class="td-show-plus show_plus">
                            <span class="btn btn-secondary btn-show-more-row">
                                <i class="fa fa-plus"></i>
                            </span>
                        </td>
                    `)
                    $(this).after(
                        `<tr class="tr-table-data"><td colspan="${self.tableData.columns.length + 2}">
                            ${self.viewDataExcepted(id)}
                        </td></tr>`)
                })
                let btnShowPlus = $(`#${this.idPage}.dataTable .btn-show-more-row`)
                $(".tr-table-data").hide()
                btnShowPlus.removeClass("active").find("i").removeClass("fa-minus").addClass("fa-plus")

                let checkboxAllGeneral = $(`#${this.idPage}.dataTable .checkbox-input-all`)
                let allRowCheckbox = $(`#${this.idPage}.dataTable .select_row .checkbox-input`)
                allRowCheckbox.prop('checked', false)
                checkboxAllGeneral.prop('checked', false)
                $(`#${self.idPage}.dataTable .dataTables_btns_multi_select`).addClass('no-selected')

                if (this.columnsExcept.length) {
                    btnShowPlus.removeClass('disabled')
                } else {
                    btnShowPlus.addClass('disabled')
                }

                $(`#${this.idPage}.dataTable .tr-table-data span[data-old-format]`).each(function () {
                    $(this).text($(this).attr('data-old-format'))
                })
            })
        },

        eventBtnsClick() {
            const self = this
            // delete row from columns excepted
            $(document).on("click", ".table tbody .tr-table-data td .btn-delete-row", function(e) {
                e.preventDefault()
                let id = $(this).parents(".tr-table-data").prev("tr").attr("data-id")
                if ($(this).hasClass('force-delete')) {
                    self.forceDeleteRow(id)
                } else {
                    self.$destroyRow(id).then(() => {
                        self.getData()
                    })
                }
            })
            // function => restore row [this btn in table data hide]
            $(document).on("click", ".table tbody .tr-table-data td .btn-restore-row", function(e) {
                e.preventDefault()
                let id = $(this).parents(".tr-table-data").prev("tr").attr("data-id")
                self.restoreRow(id)
            })

            $(document).on("change", `#${self.idPage}.dataTable .checkbox-input-all`, function() {
                let allRowCheckbox = $(`#${self.idPage}.dataTable .select_row .checkbox-input`)
                let value = $(this).prop('checked')
                if (value) {
                    allRowCheckbox.each(function() {
                        $(this).prop('checked', true)
                        $(`#${self.idPage}.dataTable .dataTables_btns_multi_select`).removeClass('no-selected')
                    })
                } else {
                    allRowCheckbox.each(function() {
                        $(this).prop('checked', false)
                        $(`#${self.idPage}.dataTable .dataTables_btns_multi_select`).addClass('no-selected')
                    })
                }
                self.tableData.countItemsSelected = allRowCheckbox.filter(':checked').length
            })

            $(document).on('change', `#${self.idPage}.dataTable .select_row .checkbox-input`, function() {
                let allRowChecked = $(`#${self.idPage}.dataTable .select_row .checkbox-input`).filter(':checked')
                let allRowCheckbox = $(`#${self.idPage}.dataTable .select_row .checkbox-input`)
                if (allRowChecked.length == allRowCheckbox.length) {
                    $(`#${self.idPage}.dataTable .checkbox-input-all`).prop('checked', true)
                } else {
                    $(`#${self.idPage}.dataTable .checkbox-input-all`).prop('checked', false)
                }

                if (allRowChecked.length) {
                    $(`#${self.idPage}.dataTable .dataTables_btns_multi_select`).removeClass('no-selected')
                } else {
                    $(`#${self.idPage}.dataTable .dataTables_btns_multi_select`).addClass('no-selected')
                }

                self.tableData.countItemsSelected = allRowChecked.length
            })
        },

        destroyRow(id, url = null) {
            this.$destroyRow(id, url).then(() => {
                this.getData()
            })
        },

        forceDeleteRow(id) {
            Swal.fire({
                title: this.$t('global.force_delete'),
                text: this.$t('messages.force_delete_msg'),
                icon: "error",
                showCancelButton: true,
                confirmButtonColor: "#e74c3c",
                cancelButtonColor: "#6d6d6d",
                confirmButtonText: this.$t('global.yes_remove_it') + "!",
                cancelButtonText: this.$t('global.cancel')
            }).then(result => {
                if (result.value) {
                    loadReq(this.$Progress)
                    axios.delete(this.urlGetDataTable + '/' + id).then(response => {
                        if (response.status === 200) {
                            ToastReq.fire({
                                text: this.$t('messages.force_delete_success_msg')
                            })
                            this.getData()
                        }
                    })
                    .catch(error => {
                        ToastFailed.fire({
                            title: this.$t('global.failed') + "!",
                            text: this.$t('messages.force_delete_failed_msg')
                        })
                        this.$Progress.fail()
                    })
                }
            })
        },

        restoreRow(id) {
            Swal.fire({
                title: this.$t('global.restore'),
                text: this.$t('messages.restore_msg'),
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#38c172",
                cancelButtonColor: "#6d6d6d",
                confirmButtonText: this.$t('global.yes_restore_it') + "!",
                cancelButtonText: this.$t('global.cancel')
            }).then(result => {
                if (result.value) {
                    loadReq(this.$Progress)
                    axios.patch(this.urlGetDataTable + '/restore/' + id).then(response => {
                        if (response.status === 200) {
                            ToastReq.fire({
                                text: this.$t('messages.restore_success_msg')
                            })
                            this.getData()
                        }
                    })
                    .catch(error => {
                        ToastFailed.fire({
                            title: this.$t('global.failed') + "!",
                            text: this.$t('messages.restore_failed_msg')
                        })
                        this.$Progress.fail()
                    })
                }
            })
        },

        deleteResotreMulti(action = 'delete') {
            const self = this
            let title = '',
                message = '',
                success_message = '',
                failed_message = '',
                confirmButtonText = '',
                confirmButtonColor = '#e74c3c'

            if (action === 'delete') {
                confirmButtonText = this.$t('global.yes_delete_it') + "!"
                title = this.$t('global.delete')
                message = this.$t('messages.multi_delete_msg')
                success_message = this.$t('messages.multi_delete_success_msg')
                failed_message = this.$t('messages.multi_delete_failed_msg')
            } else if (action === 'force_delete') {
                confirmButtonText = this.$t('global.yes_remove_it') + "!"
                title = this.$t('global.force_delete')
                message = this.$t('messages.multi_force_delete_msg')
                success_message = this.$t('messages.multi_force_delete_success_msg')
                failed_message = this.$t('messages.multi_force_delete_failed_msg')
            } else if (action === 'restore') {
                confirmButtonColor = '#38c172'
                confirmButtonText = this.$t('global.yes_restore_it') + "!"
                title = this.$t('global.restore')
                message = this.$t('messages.multi_restore_msg')
                success_message = this.$t('messages.multi_restore_success_msg')
                failed_message = this.$t('messages.multi_restore_failed_msg')
            }

            Swal.fire({
                title: title,
                text: message,
                icon: action === 'force_delete' ? 'error' : 'warning',
                showCancelButton: true,
                confirmButtonColor: confirmButtonColor,
                cancelButtonColor: "#6d6d6d",
                confirmButtonText: confirmButtonText,
                cancelButtonText: this.$t('global.cancel')
            }).then(result => {
                if (result.value) {
                    loadReq(this.$Progress)
                    let allRowCheckbox = $(`#${self.idPage}.dataTable .select_row .checkbox-input`)
                    const data = {
                        ids: [],
                        action: action, // delete, force_delete, restore
                    }
                    allRowCheckbox.each(function() {
                        if ($(this).is(':checked')) {
                            data.ids.push($(this).val())
                        }
                    })
                    axios.post(this.urlGetDataTable + '/delete_restore_multi', data).then(response => {
                        if (response.status === 200) {
                            if (response.data.status === true) {
                                ToastReq.fire({
                                    text: success_message
                                })
                                this.getData()
                            } else {
                                ToastFailed.fire({
                                    title: this.$t('global.failed') + "!",
                                    text: failed_message
                                })
                                this.$Progress.fail()
                            }
                        }
                    })
                    .catch(error => {
                        ToastFailed.fire({
                            title: this.$t('global.failed') + "!",
                            text: failed_message
                        })
                        this.$Progress.fail()
                    })
                }
            })
        },

        setColumnsAndOrders() {
            let newColumnsAfterChangeLang = []

            // add columns dynamic
            this.columns.unshift({ label: "#", name: "index" })
            this.columns.unshift({ label: "<i class='fa fa-plus'></i>", name: "show_plus" })
            if (!this.hideMultiSelect) {
                this.columns.unshift({ label: `
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="checkbox-input-all custom-control-input" id="select_all">
                        <label class="custom-control-label" for="select_all"></label>
                    </div>
                `, name: "select_row" })
            }
            this.columns.push({ label: "Actions", name: "actions" })
            /* ============================================== */

            this.columns.forEach(item => {
                if (item.name != 'show_plus' && item.name != 'index' && item.name != 'select_row') {
                    item.label = this.$t(this.idPage + '_table.' + item.name)
                    this.sortOrders[item.name] = -1
                }
                newColumnsAfterChangeLang.push(item)
            })
            this.columns = newColumnsAfterChangeLang


            // set columns exepted sorting in locale index model

            const oldColumnExepted = [...this.tableData.filter.columnsExcept]
            this.tableData.filter.columnsExcept = oldColumnExepted.concat(this.columnsExceptedSorting)
        },


        /* ============================================================================================
            settings table (change filter columns) */

        toggleShowSettings() {
            this.showSettings = !this.showSettings
        }


        /* ============================================================================================ */
    },

    mounted() {
        this.eventBtnsClick()
        this.setColumnsAndOrders()
        this.viewFilterColumns()
        window.onresize = () => { this.viewFilterColumns() }
        this.$nextTick(() => { this.getData() })
    },
}
