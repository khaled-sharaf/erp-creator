export default {
    methods: {
        sellProduct(product) {
            Swal.fire({
                title: this.sell_product_title, // selling product
                text: this.sell_product_msg + product.count_selling,  // count of selling old is : 50
                html: `
                    <div class="form-add-sales-in-sweetalert">
                        <div class="form-group">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="add_sales" name="restore_product" class="custom-control-input" ${product.product_count < 1 ? 'disabled': 'checked'}>
                                <label class="custom-control-label" for="add_sales">${this.add_sales}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="restore_sales" name="restore_product" class="custom-control-input" ${product.product_count < 1 ? 'checked': ''}>
                                <label class="custom-control-label" for="restore_sales">${this.restore_sales}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="increase_decrease_current_products" checked="checked">
                                <label class="custom-control-label" for="increase_decrease_current_products">${this.title_label_affected_products_count_in_selling}</label>
                            </div>
                        </div>
                    </div>
                `,
                inputValue: '1',
                preConfirm: () => {
                    return {
                        "sales_count": Swal.getInput().value,
                        "add_sales": document.getElementById('add_sales').checked,
                        "increase_decrease_current_products": document.getElementById('increase_decrease_current_products').checked
                    }
                },
                inputValidator: (value) => {
                    let increase_decrease_current_products = document.getElementById('increase_decrease_current_products').checked,
                        add_sales = document.getElementById('add_sales').checked;
                    if (!value || value == '' || parseInt(value) < 1) {
                        return this.msg_empty_count_selling;
                    } else if (increase_decrease_current_products === true && add_sales === true && (parseInt(value) > product.product_count)) {
                        return this.msg_error_product_count_less_than_count_sales;
                    } else if (add_sales === false && (parseInt(value) > product.count_selling)) {
                        return this.msg_error_current_count_sales_less_than_count_sales_input
                    }
                },
                input: 'number',
                inputPlaceholder: this.placeholder_input_sales_count,
                type: "info",
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonColor: "#38c172",
                cancelButtonColor: "#6d6d6d",
                confirmButtonText: this.add_salse_product_title,
                cancelButtonText: this.cancel_title,

            })
            .then(result => {
                let data = result.value;
                if (data) {
                    data.id = product.id
                    loadReq(this.$Progress);
                    axios.post(this.urlSellProduct, data).then(response => {
                        if (response.status === 200) {
                            if (response.data.status === true) {
                                ToastReq.fire({
                                    text: this.sell_product_success_msg
                                });
                                if (this.typePage == 'profile') {
                                    let product = response.data.product
                                    if (product.gallery !== null && product.gallery != '') {
                                        let gallery = product.gallery.split(',')
                                        let galleryArr = []
                                        gallery.forEach(image => {
                                            galleryArr.push({id:  Math.floor(Math.random() * 10000), url: image})
                                        })
                                        product.gallery = galleryArr
                                    } else {
                                        product.gallery = []
                                    }
                                    this.productProfile = product
                                } else {
                                    this.getData();
                                }
                            }
                        }
                    })
                    .catch(error => {
                        ToastFailed.fire({
                            title: this.failed_title + "!",
                            text: this.sell_product_failed_msg,
                        })
                        this.$Progress.fail();
                    });
                }
            });
        },
    }
}
