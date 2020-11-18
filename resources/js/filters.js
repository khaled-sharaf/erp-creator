import Vue from 'vue'
/* filters */

// capitalize
Vue.filter("capitalize", value => {
    if (!value) return "";
    value = value.toString();
    return value.charAt(0).toUpperCase() + value.slice(1);
});
/*****************************************************************************/

// uppercase
Vue.filter("uppercase", value => {
    if (!value) return "";
    value = value.toString();
    return value.toUpperCase();
});
/*****************************************************************************/

// slug
Vue.filter("slug", value => {
    if (!value) return "";
    value = value.toString();
    return value.replace(/[-_.,]/g, ' ');
});
/*****************************************************************************/

Vue.filter("pluralizes", value => {
    if (!value) return "";
    return value === 1 ? value : value + 's'
});
/*****************************************************************************/
