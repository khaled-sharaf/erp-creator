import Vue from "vue"
import VueProgressBar from "vue-progressbar"

Vue.use(VueProgressBar, {
    color: "#38c172",
    failedColor: "#e3342f"
})

const calculatePercentage = (loaded, total) => (Math.floor(loaded * 1.0) / total)

const setupUpdateProgress = ($progress) => {
    axios.defaults.onDownloadProgress = e => {
        const percentage = calculatePercentage(e.loaded, e.total)
        // NProgress.set(percentage)
        $progress.set(percentage)
    }
}

const setupStopProgress = ($progress) => {
    axios.interceptors.response.use(response => {
        $progress.finish();
        // $progress.done(true); // NProgress
        return response
    })
}

export function loadReq($progress) {
    // $progress.configure(config) // NProgress
    $progress.start()
    setupUpdateProgress($progress)
    setupStopProgress($progress)
}

window.loadReq = loadReq
