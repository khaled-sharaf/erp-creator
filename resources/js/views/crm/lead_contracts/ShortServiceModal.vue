<template>
    <!-- Modal -->
    <div class="modal fade" id="shortServiceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create New Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="handleSubmit" ref="formRef">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" v-model="formData.name" required>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" class="form-control" id="amount"  v-model="formData.amount" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" rows="3" v-model="formData.description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" :disabled="loading">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data:()=>({
        loading: false,
        formData: new Form({
            name: "tommy",
            description: "description",
            amount:"1",
            profit_method: 1
        }),
        urlModel: "/services"
    }),
    mounted(){
        $("#shortServiceModal").on("hidden.bs.modal",(e)=>{
            this.$refs['formRef'].reset()
        })
    },
    methods: {
        handleSubmit(){
            this.loading = true;
            loadReq(this.$Progress)
            this.formData.post(this.urlModel)
            .then(response => {
                if (response.status === 200) {
                    this.loading = false;
                    this.formData.reset();
                    this.closeModal();
                    this.$emit("newService", response.data)
                    ToastReq.fire({
                        text: this.success_msg,
                        icon: 'success'
                    });
                }
            }).catch(({response}) => {
                this.loading = false;
                if(response){
                    const { errors, message } = response.data
                    console.log(Object.entries(errors));
                    let arr = [];
                    for (let [key, value] of Object.entries(errors)){
                        arr = [...arr, value[0]]
                    }
                    ToastFailed.fire({
                        title: "Faild",
                        html: `
                            ${arr.map(text=>(`<p class="mb-0">${text}</p>`))}
                        `,
                        icon: 'error'
                    })

                }else{
                    ToastFailed.fire({
                        title: this.failed_title + "!",
                        text: this.failed_msg,
                        icon: 'error'
                    })
                }

                this.$Progress.fail()
            });

        },
        closeModal(){
            $("#shortServiceModal").modal("hide")
        }
    },

}
</script>

<style>

</style>