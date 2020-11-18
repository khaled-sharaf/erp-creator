

export default {
    data() {
        return {
            success_msg: " ",
            failed_msg: " ",
            failed_title: " ",
        }
    },
    methods: {
        setLocaleMessages() {
            this.failed_title = this.$t('global.failed')
            this.success_msg = this.$t(`${this.idPage}_table.p_${this.typePage}.success_msg`)
            this.failed_msg = this.$t(`${this.idPage}_table.p_${this.typePage}.failed_msg`)
        }
    },
    watch: {
        "$i18n.locale"(val) {
            this.setLocaleMessages()
        },
    },
    mounted() {
        this.setLocaleMessages()
    },
}
