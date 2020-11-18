<template>
    <div id="table-settings-wrapper">
        <div
            class="btn-settings-table"
            @click="toggleShowSettings()"
        >
            <i class="fas fa-cog"></i>
        </div>
        <transition name="bounce-settings-wrapper">
            <div
                class="table-settings-view"
                v-show="showSettings"
                @click.self="toggleShowSettings()"
            >
                <div class="content-settings-wrapper">
                    <!-- header -->
                    <header class="header">
                        <button
                            class="btn btn-transparent btn-close-settings"
                            @click="toggleShowSettings()"
                        >
                            <span></span>
                            <span></span>
                        </button>

                    </header> <!-- ./header -->
                    <!-- ================================================================== -->


                    <!-- main -->
                    <main class="content-settings-view">
                        <header class="header-content">
                            <h2
                                class="title"
                                v-html="$t('global.settings_table', {model: '<span class=\'model-name\'>' + $t('sidebar.' + idPage) + '</span>'})">
                            </h2>
                        </header><!-- ./header content -->
                        <!-- ======================================================== -->


                        <!-- section screens in object -->
                        <div class="sections-screen-wrapper">

                            <!-- section is contain one screen size object -->
                            <section class="screen" v-for="(screen, index) in screenSizes" :key="index" :class="{'dis-active': !screen.active}">
                                <div class="size-wrapper">
                                    <div class="screen-active-wrapper">
                                        <div class="custom-control custom-checkbox" v-if="screen.screenSize !== 'default'">
                                            <input
                                                type="checkbox"
                                                v-model="screen.active"
                                                class="checkbox-screen-active custom-control-input"
                                                :id="'screen-active-' + index"
                                            >
                                            <label class="custom-control-label" :for="'screen-active-' + index"></label>
                                        </div>
                                    </div>
                                    <div class="screen-label">
                                        <span class="badge badge-danger" v-text="screen.label"></span>
                                    </div>
                                </div>

                                <div class="screen-columns">
                                    <div class="column" v-for="(column, idx) in columns" :key="idx" v-if="column.name != 'select_row' && column.name != 'show_plus'">
                                        <span
                                            class="badge"
                                            :class="classColumnActive(index, column.name)"
                                            v-html="column.label"
                                            @click="toggleShow(index, column.name)"
                                            >
                                        </span>
                                    </div>
                                </div>



                            </section><!-- ./section screen -->
                            <!-- ======================================================== -->

                        </div><!-- ./sections screen wrapper -->
                    </main> <!-- ./main -->
                    <!-- ================================================================== -->


                    <!-- footer -->
                    <footer class="footer">
                        <button
                            class="btn btn-success btn-sm btn-save-settings"
                            type="button"
                            @click="saveSettings()"
                        >
                            {{ $t('global.save') }}
                        </button>
                    </footer> <!-- ./footer -->
                    <!-- ================================================================== -->


                </div>
            </div>
        </transition>
    </div>
</template>


<script>
    export default {
        props: [
            'showSettings',
            'idPage',
            'columns',
            'toggleShowSettings'
        ],
        data() {
            return {
                urlGetData: '/setting/settings/get/',
                successGetSettings: false,
                oldSettingsDB: {},
                screenSizes: [
                    {
                        label: 'Default',
                        screenSize: 'default',
                        active: true,
                        showColumns: []
                    },
                    {
                        label: '1920px and down',
                        screenSize: 1920,
                        active: false,
                        showColumns: []
                    },
                    {
                        label: '1366px and down',
                        screenSize: 1366,
                        active: false,
                        showColumns: []
                    },
                    {
                        label: '1200px and down',
                        screenSize: 1200,
                        active: false,
                        showColumns: []
                    },
                    {
                        label: '1024px and down',
                        screenSize: 1024,
                        active: false,
                        showColumns: []
                    },
                    {
                        label: '768px and down',
                        screenSize: 768,
                        active: false,
                        showColumns: []
                    },
                    {
                        label: '600px and down',
                        screenSize: 600,
                        active: false,
                        showColumns: []
                    },
                    {
                        label: '400px and down',
                        screenSize: 400,
                        active: false,
                        showColumns: []
                    }
                ],
            }
        },
        methods: {
            toggleShow(indexScreen, columnName) {
                const currentScreen = this.screenSizes[indexScreen]

                if (currentScreen.showColumns.indexOf(columnName) == -1) {
                    currentScreen.showColumns.push(columnName)
                } else {
                    const indexColumnName = currentScreen.showColumns.findIndex(item => item == columnName)
                    currentScreen.showColumns.splice(indexColumnName, 1)
                }
            },

            classColumnActive(indexScreen, columnName) {
                if (this.screenSizes[indexScreen].showColumns.indexOf(columnName) == -1) {
                    return 'badge-secondary'
                } else {
                    return 'badge-info'
                }
            },

            getSettings() {
                axios.get(this.urlGetData + this.$nameSettingsInDB).then(response => {
                    if (response.status === 200) {
                        const setting = response.data.setting
                        if (typeof response.data === 'object') {
                            if (setting != null) {
                                this.successGetSettings = true
                                if (setting === '') setting = '{}'
                                this.oldSettingsDB = {...JSON.parse(setting)}
                                localStorage.setItem(this.$nameSettingsInDB, setting)
                            } else {
                                this.oldSettingsDB = {}
                                localStorage.setItem(this.$nameSettingsInDB, '{}')
                            }
                        } else {
                            setTimeout(() => {
                                this.getSettings()
                            }, 500)
                        }
                    }
                })
                .catch(errors => {
                    setTimeout(() => {
                        this.getSettings()
                    }, 500)
                })
            },

            saveSettingsInDB(settings) {
                const data = {
                    name: this.$nameSettingsInDB,
                    value: JSON.stringify(settings)
                }
                axios.put('/settings/save', data).then(response => {
                    // localStorage.setItem(this.$nameSettingsInDB, JSON.stringify(settings))
                }).catch(errors => {
                    console.log(errors)
                })
            },

            saveSettings() {
                const oldSettings = {...JSON.parse(localStorage.getItem(this.$nameSettingsInDB))}
                oldSettings[this.idPage] = this.screenSizes
                this.saveSettingsInDB(oldSettings)
                localStorage.setItem(this.$nameSettingsInDB, JSON.stringify(oldSettings))

                // close settings
                this.toggleShowSettings()
            },

            setScreenSizesFromLocale() {
                setTimeout(() => {
                    this.getSettings()
                    const getOldSettings = setInterval(() => {
                        if (this.successGetSettings) {
                            clearInterval(getOldSettings)
                            const oldSettings = {...this.oldSettingsDB}
                            if (oldSettings[this.idPage]) {
                                this.screenSizes = oldSettings[this.idPage]
                            } else {
                                oldSettings[this.idPage] = this.screenSizes
                                this.saveSettingsInDB(oldSettings)
                                localStorage.setItem(this.$nameSettingsInDB, JSON.stringify(oldSettings))
                            }
                        }
                    }, 200);
                }, 600);
            }
        },
        mounted() {
            setTimeout(() => {
                this.screenSizes[0].showColumns = this.columns.filter(column => {
                    return column.name != 'select_row' && column.name != 'show_plus'
                })
                .map(column => {
                    if (column.name != 'select_row' && column.name != 'show_plus') {
                        return column.name
                    }
                })
            }, 500);

            // set settings form localStorage
            this.setScreenSizesFromLocale()


            // trigger overlayScrollbars
            $(".content-settings-view").overlayScrollbars({
                scrollbars: {
                    autoHide: "m"
                }
            });
        },
    }
</script>

