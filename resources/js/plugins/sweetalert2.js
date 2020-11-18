import Swal from "sweetalert2";
window.Swal = Swal;

const ToastReq = Swal.mixin({
    position: "top-end",
    showConfirmButton: false,
    timer: 1500,
    icon: "success",
});
const ToastFailed = Swal.mixin({
    showConfirmButton: false,
    icon: 'error',
    // timer: 1500,
});

const toastMsg = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})


window.ToastReq = ToastReq;
window.ToastFailed = ToastFailed;
window.toastMsg = toastMsg;