import Vue from 'vue'
import moment from 'moment'
Vue.prototype.moment = moment

Vue.component("relative-date", {
    props: ["date"],
    // template: "<span :style='styling' @mouseenter='toggleDate' @mouseleave='toggleDate' :data-old-format='dateFormat' :data-new-format='timestamp'>{{ timestamp }} </span>",
    template: "<span :style='styling' @click='toggleDate' :data-old-format='dateFormat' :data-new-format='timestamp'>{{ timestamp }} </span>",
    created() {
        let self = this;
        setInterval(() => {
            self.$data.dateNow = Date.now();
        }, 1000 * 10);
    },
    data() {
        return {
            dateNow: Date.now(),
            dateFormat: moment(String(this.date)).format('YYYY MMMM DD - hh:mm A'),
            styling: {
                cursor: 'default',
                textAlign: 'left',
                direction: 'ltr',
                display: 'inline-block'
            },
            showRelativeDate: true
        };
    },
    methods: {
        toggleDate() {
            this.showRelativeDate = !this.showRelativeDate;
        }
    },
    computed: {
        timestamp() {
            if (this.date !== null) {
                if (this.showRelativeDate) {
                    return moment(this.date)
                        .startOf("second")
                        .from(this.$data.dateNow);
                } else {
                    return moment(String(this.date)).format('YYYY MMMM DD - hh:mm A');
                }
            } else {
                return null;
            }
        }
    }
})


Vue.component("rates-stars", {
    props: {
        'rates-count': {
            type: Number,
            required: true
        }
    },
    template: `<div class="wrapper-stars-rating">
        <i class="stars-rating">
            <i class="regular" :style="{backgroundImage: 'url(' + $domain + 'admin/images/5-stars-regular.png)'}"></i>
            <i class="solid" :style="{width: ratesCount + '%', backgroundImage: 'url(' + $domain + 'admin/images/5-stars-solid.png)'}"></i>
        </i>
        <slot></slot>
    </div>`, //  v-html="countStarRate"
})
