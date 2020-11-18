<template>
    <!-- Modal -->
    <div class="modal fade" id="shortLeadModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create New Lead</h5>
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
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email"  v-model="formData.email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone"  v-model="formData.phone" required>
                        </div>
                        <div class="form-group">
                            <label for="whatsapp_phone">Whatsapp Phone</label>
                            <input type="text" class="form-control" id="whatsapp_phone"  v-model="formData.whatsapp_phone" required>
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
            phone: "01090350064",
            whatsapp_phone: "01090350064",
            email:"mail@mail.com",
            type: 0
        }),
        urlModel: "/leads_new"
    }),
    mounted(){
        $("#shortLeadModal").on("hidden.bs.modal",(e)=>{
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
                    console.log(response);

                    this.loading = false;
                    this.formData.reset();
                    this.closeModal();
                    this.$emit("newLeadSelect", response.data)
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
            $("#shortLeadModal").modal("hide");
        }
    },

}
</script>

<style>

</style>