
import Vue from 'vue'
import moment from 'moment'
Vue.prototype.moment = moment

window.$can = function(permission) {
    return Vue.prototype.$permissionsActive ? (window.$user_permissions.indexOf(permission) != -1 ? true : false) : true
}
Vue.prototype.$can = $can


window.$getLeadStatuses = async function() {
    return await axios.get('/crm/lead_statuses_select').then(response => {
        if (response.status === 200 && typeof response.data === 'object') {
            return response.data.statuses
        } else {
            setTimeout(() => {
                $getLeadStatuses()
            }, 500)
        }
    })
    .catch(errors => {
        setTimeout(() => {
            $getLeadStatuses()
        }, 500)
    })
}

/**************************************************************************************/

window.$getLeadsSelect = async function() {
    return await axios.get('/crm/leads_select').then(response => {
        if (response.status === 200 && typeof response.data === 'object') {
            return response.data
        } else {
            setTimeout(() => {
                $getLeadsSelect()
            }, 500)
        }
    })
    .catch(errors => {
        setTimeout(() => {
            $getLeadsSelect()
        }, 500)
    })
}

/**************************************************************************************/


window.$getUsersSelect = async function() {
    return await axios.get('/hr/users_select?department_name=sales').then(response => {
        if (response.status === 200 && typeof response.data === 'object') {
            return response.data
        } else {
            setTimeout(() => {
                $getUsersSelect()
            }, 500)
        }
    })
    .catch(errors => {
        setTimeout(() => {
            $getUsersSelect()
        }, 500)
    })
}

/**************************************************************************************/


window.$getServicesSelect = async function() {
    return await axios.get('/crm/services_select').then(response => {
        if (response.status === 200 && typeof response.data === 'object') {
            return response.data
        } else {
            setTimeout(() => {
                $getServicesSelect()
            }, 500)
        }
    })
    .catch(errors => {
        setTimeout(() => {
            $getServicesSelect()
        }, 500)
    })
}

/**************************************************************************************/


window.$getSalesCommissionsSelect = async function() {
    return await axios.get('/crm/sales_commissions').then(response => {
        if (response.status === 200 && typeof response.data === 'object') {
            return response.data.commissions
        } else {
            setTimeout(() => {
                $getSalesCommissionsSelect()
            }, 500)
        }
    })
    .catch(errors => {
        setTimeout(() => {
            $getSalesCommissionsSelect()
        }, 500)
    })
}

/**************************************************************************************/


window.$getPlatforms = async function() {
    return await axios.get('/projectmanagement/platforms').then(response => {
        if (response.status === 200 && typeof response.data === 'object') {
            return response.data.platforms
        } else {
            setTimeout(() => {
                $getPlatforms()
            }, 500)
        }
    })
    .catch(errors => {
        setTimeout(() => {
            $getPlatforms()
        }, 500)
    })
}

Vue.prototype.$endContractDate = function(model) {
    return moment(String(model.start_date)).add(model.duration, model.duration_unit).format('YYYY-MM-DD')
}


Vue.prototype.$destroyRow = function(id, url = null, messageQues = null, deleteSuccessMsg = null) {
    let deleteUrl = url == null ? this.urlGetDataTable : url
    deleteUrl = deleteUrl.indexOf('/') === deleteUrl.length - 1 ? deleteUrl : deleteUrl + '/'

    let msgQues = messageQues == null ? this.$t('messages.delete_msg') : messageQues
    let successMsg = deleteSuccessMsg == null ? this.$t('messages.delete_success_msg') : deleteSuccessMsg

    return new Promise((resolve, reject) => {
        Swal.fire({
            title: this.$t('global.delete'),
            text: msgQues,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#e74c3c",
            cancelButtonColor: "#6d6d6d",
            confirmButtonText: this.$t('global.yes_delete_it') + "!",
            cancelButtonText: this.$t('global.cancel')
        }).then(result => {
            if (result.value) {
                loadReq(this.$Progress)
                axios.delete(deleteUrl + id).then(response => {
                    if (response.status === 200) {
                        ToastReq.fire({
                            text: successMsg
                        })
                        resolve(response)
                    }
                })
                .catch(error => {
                    ToastFailed.fire({
                        title: this.$t('global.failed') + "!",
                        text: this.$t('messages.delete_failed_msg')
                    })
                    this.$Progress.fail()
                    reject(error)
                })
            }
        })
    })
}



Vue.prototype.$createNewProject = function(id) {
    return new Promise((resolve, reject) => {
        Swal.fire({
            title: this.$t('global.create'),
            text: this.$t('projects_table.ask_create_new'),
            icon: "info",
            showCancelButton: true,
            confirmButtonColor: "#38c172",
            cancelButtonColor: "#6d6d6d",
            confirmButtonText: this.$t('global.create') + "!",
            cancelButtonText: this.$t('global.cancel')
        }).then(result => {
            if (result.value) {
                loadReq(this.$Progress)
                const data = {
                    lead_contract_id: id
                }
                axios.post('/projectmanagement/projects', data).then(response => {
                    if (response.status === 200) {
                        ToastReq.fire({
                            text: this.$t('projects_table.p_create.success_msg')
                        })
                        resolve(response)
                    }
                })
                .catch(error => {
                    ToastFailed.fire({
                        title: this.$t('global.failed') + "!"
                    })
                    this.$Progress.fail()
                    reject(error)
                })
            }
        })
    })
}


Vue.prototype.$activeProject = function(id, type) {
    return new Promise((resolve, reject) => {
        Swal.fire({
            title: this.$t('global.activation'),
            text: this.$t('projects_table.ask_activation'),
            icon: "info",
            showCancelButton: true,
            confirmButtonColor: "#38c172",
            cancelButtonColor: "#6d6d6d",
            confirmButtonText: this.$t('global.activate') + "!",
            cancelButtonText: this.$t('global.cancel')
        }).then(result => {
            if (result.value) {
                loadReq(this.$Progress)
                const data = {
                    type: type
                }
                axios.post('projects/activate/' + id, data).then(response => {
                    if (response.status === 200) {
                        ToastReq.fire({
                            text: this.$t('projects_table.p_active.success_msg')
                        })
                        resolve(response)
                    }
                })
                .catch(error => {
                    ToastFailed.fire({
                        title: this.$t('global.failed') + "!"
                    })
                    this.$Progress.fail()
                    reject(error)
                })
            }
        })
    })
}

/* ================================================================================================ */
// donwload multi images

Vue.prototype.$downloadMultiImage = function(images, name = 'image') {
    let temporaryDownloadLink = document.createElement("a");
        temporaryDownloadLink.style.display = 'none';
        document.body.appendChild( temporaryDownloadLink );
    for(let n = 0; n < images.length; n++) {
        var download = images[n];
        temporaryDownloadLink.setAttribute( 'href', Vue.prototype.$domain + download.value );
        temporaryDownloadLink.setAttribute( 'download', name + '-' + (n + 1) );
        temporaryDownloadLink.click();
    }
    document.body.removeChild( temporaryDownloadLink );
}

/* ================================================================================================ */

// showGoogleMapInForm in form

Vue.prototype.$showGoogleMapInForm = function() {
    const oldScript = $('#scriptMapInForm')
    if (oldScript.length) {
        oldScript.remove()
    }
    var scriptMap = document.createElement('script')
    document.body.appendChild(scriptMap)
    scriptMap.id = 'scriptMapInForm'
    scriptMap.setAttribute('async', true)
    scriptMap.setAttribute('defer', true)
    scriptMap.setAttribute('src', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyADsFcbM6g-A_nUwh41pFn9EgDdlRC6lGY&language=ar&region=EG&callback=initMapInForm')
}
/* ================================================================================================ */

// showGoogleMap in profile
Vue.prototype.$showGoogleMap = function(lat, long) {
    if (lat != null && long != null) {
        var show_my_map = $('#show_my_map')
        show_my_map.attr('data-lat', lat).attr('data-long', long)
        const oldScript = $('#myScriptMap')
        if (oldScript.length) {
            oldScript.remove()
        }
        var scriptMap = document.createElement('script')
        document.body.appendChild(scriptMap)
        scriptMap.id = 'myScriptMap'
        scriptMap.setAttribute('async', true)
        scriptMap.setAttribute('defer', true)
        scriptMap.setAttribute('src', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyADsFcbM6g-A_nUwh41pFn9EgDdlRC6lGY&language=ar&region=EG&callback=initMap')
    }
}
/* ================================================================================================ */
/* ================================================================================================ */

// Get System Curriencies
window.$getSystemCurrencies = async()=>{
    console.log("currency");
    return await axios.get('/currencies')
    .then(({data}) => data)
    .catch(errors => {
        // setTimeout(() => {
        //     $getLeadStatuses()
        // }, 500)
    })
}
/* ================================================================================================ */
