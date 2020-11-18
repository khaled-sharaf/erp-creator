<template>
    <div class="wrapper-upload-image">
         <!-- image -->

        <div v-if="!type || type !== 'multiple'" class="wrapper-drop-image single-image" :class="{'contains-image': form[propertyName] != '' && form[propertyName] !== null, 'is-invalid': form.errors.has(formError), [formError]: true}">
            <div class="overlay-drop-image">
                <div class="view-images">

                    <div class="image" v-if="form[propertyName] !== '' && form[propertyName] !== null">
                        <div class="img">
                            <!-- <img :src="addDomainToImage(form[propertyName])"> -->
                            <div v-if="showBtnRemoveSingleImage" class="remove-image" @click="removeSingleImage()"><i class="fas fa-times"></i></div>
                        </div>
                    </div>
                </div>

                <label class="view-overlay" :for="formError">
                    <div class="content-overlay">
                        <i class="icon far fa-image"></i>
                        <span class="title"> {{ $t('global.drag_msg') }} </span>
                    </div>
                </label>
            </div>
            <input
                type="file"
                class="custom-file-drop custom-file-input"
                :id="formError"
                accept="image/*"
                @change="showFiles($event.target.files, $event.target.id, propertyName, formError)"
                :class="{ 'is-invalid': form.errors.has(formError) }"
            >
            <has-error :form="form" :field="formError"></has-error>
        </div>

        <!-- ./image -->

        <!-- gallery -->

        <div v-if="type && type === 'multiple'" class="wrapper-drop-image multi-image"  :class="{'contains-image': form[propertyName] !== null && form[propertyName] !== '' && form[propertyName].length > 0, 'is-invalid': form.errors.has(formError), [formError]: true}"> <!-- contains-image -->
            <div class="overlay-drop-image" :for="formError">
                <div class="view-images">
                    <div class="image elevation-5" v-for="(image, index) in form[propertyName]" :key="index">
                        <div class="img">
                            <img :src="addDomainToImage(image.value)">
                            <div class="remove-image" @click="removeImage(index)"><i class="fas fa-times"></i></div>
                        </div>
                    </div>
                </div>
                <label class="view-overlay" :for="formError">
                    <div class="content-overlay">
                        <i class="icon far fa-image"></i>
                        <span class="title"> {{ $t('global.drag_msg') }} </span>
                    </div>
                </label>
            </div>
            <input
                type="file"
                class="custom-file-drop custom-file-input"
                :id="formError"
                accept="image/*"
                @change="showFiles($event.target.files, $event.target.id, propertyName, formError)"
                :class="{ 'is-invalid': form.errors.has(formError) }"
                multiple
            >
            <has-error :form="form" :field="formError"></has-error>
        </div>

        <!-- ./gallery -->

    </div>
</template>


<script>
export default {
    props: {
        type: String,
        required: {
            type: Boolean,
            default: true
        },
        defaultSrcImage: String,
        propertyName: {
            type: String,
            required: true
        },
        propertyDeletedName: String,
        form: {
            type: Object,
            required: true
        },
        propertyArrayRecursive: {
            type: Object
        },
        pathError: {
            type: String
        },
        maxCount: {
            type: Number,
            default: 50
        },
        maxSize: {
            type: Number,
            default: 5242880
        },
    },
    data() {
      return {
        error: true,
        maxSizeMb: (this.maxSize / 1024 / 1024).toFixed(1),
        showBtnRemoveSingleImage: false
      }
    },
    methods: {

        handelForm(value = null) {
            if (value != null) {
                if (typeof this.propertyArrayRecursive === 'object') {
                    this.propertyArrayRecursive[this.propertyName] = value
                } else {
                    this.form[this.propertyName] = value
                }
            }
            if (typeof this.propertyArrayRecursive === 'object') {
                return this.propertyArrayRecursive[this.propertyName]
            } else {
                return this.form[this.propertyName]
            }
        },
        encodeFileAsURL(files, propertyName, formError) {
            let self = this;
            if (files.length) {
                if (this.maxCount) {
                    if ((this.form[propertyName].length + files.length) > this.maxCount) {
                        this.error = true
                        if (this.$i18n.locale == 'ar') {
                            Swal.fire(
                                "خطأ...",
                                `يجب عليك تحميل  ${this.maxCount} صور أو أقل.`,
                                "error"
                            );
                        } else {
                            Swal.fire(
                                "Oops...",
                                `You must upload ${this.maxCount} images or less.`,
                                "error"
                            );
                        }
                    } else {
                        this.error = false
                    }
                } else {
                    this.error = false
                }
                if (!this.error) {
                    for (let i = 0; i < files.length; i++) {
                        let file = files[i]
                        let reader = new FileReader();
                        reader.onloadend = function() {
                            if (self.propertyName === propertyName) {
                                self.form[self.propertyName].push({value: reader.result})
                            }
                        };
                        if (file) {
                            if (file["size"] > this.maxSize) {
                                if (this.$i18n.locale == 'ar') {
                                    Swal.fire(
                                        "خطأ...",
                                        `الحجم المسموح به للصورة هو ${this.maxSizeMb} ميجا بايت.`,
                                        "error"
                                    );
                                } else {
                                    Swal.fire(
                                        "Oops...",
                                        `You are uploading a large file ${this.maxSizeMb}MB last.`,
                                        "error"
                                    );
                                }
                            } else if (file['type'] != 'image/jpeg' && file['type'] != 'image/png' && file['type'] != 'image/gif') {
                                if (this.$i18n.locale == 'ar') {
                                    Swal.fire(
                                        "خطأ...",
                                        "يجب أن تكون الصورة لها امتداد من هذه الإمتدادات [jpg, png, gif].",
                                        "error"
                                    );
                                } else {
                                    Swal.fire(
                                        "Oops...",
                                        "You must be image have extension between [jpg, png, gif].",
                                        "error"
                                    );
                                }
                            } else {
                                reader.readAsDataURL(file);
                            }
                        }
                    }
                }
            } else {
                let file = files;
                let reader = new FileReader();
                reader.onloadend = function() {
                    if (self.propertyName === propertyName) {
                        self.form[self.propertyName] = reader.result
                    }
                };
                if (file) {
                    if (file["size"] > this.maxSize) {
                        if (this.$i18n.locale == 'ar') {
                            Swal.fire(
                                "خطأ...",
                                `الحجم المسموح به للصورة هو ${this.maxSizeMb} ميجا بايت.`,
                                "error"
                            );
                        } else {
                            Swal.fire(
                                "Oops...",
                                `You are uploading a large file ${this.maxSizeMb}MB last.`,
                                "error"
                            );
                        }
                    } else if (file['type'] != 'image/jpeg' && file['type'] != 'image/png' && file['type'] != 'image/gif') {
                        if (this.$i18n.locale == 'ar') {
                            Swal.fire(
                                "خطأ...",
                                "يجب أن تكون الصورة لها امتداد من هذه الإمتدادات [jpg, png, gif].",
                                "error"
                            );
                        } else {
                            Swal.fire(
                                "Oops...",
                                "You must be image have extension between [jpg, png, gif].",
                                "error"
                            );
                        }
                    } else {
                        reader.readAsDataURL(file);
                    }
                }
            }
        },
        showFiles(files, input, propertyName, formError) {
            if (typeof input === 'string') {
                input = $('#' + input)
            }
            let lengthFiles = files.length;
            if (input.attr('multiple')) {
                if (lengthFiles > 0) {
                    this.encodeFileAsURL(files, propertyName, formError)
                }
            } else {
                if (lengthFiles > 0) {
                    this.encodeFileAsURL(files[0], propertyName, formError)
                }
            }
        },
        removeImage(index) {
            if (this.form[this.propertyName][index].id) {
                this.form[this.propertyDeletedName].push(this.form[this.propertyName][index])
            }
            this.form[this.propertyName].splice(index, 1)
        },
        removeSingleImage() {
            if (this.defaultSrcImage) {
                this.form[this.propertyName] = this.defaultSrcImage
            } else {
                this.form[this.propertyName] = ''
            }
        },
        handelDropImages() {
            const self = this;
            // view-images
            $('.wrapper-drop-image.' + self.propertyName).on('drag dragstart dragend dragover dragenter dragleave drop', function(e) {
                e.preventDefault();
                e.stopPropagation();
            }).on('dragover dragenter', function(e) {
                $(this).addClass('is-dragover');
            })
            .on('dragleave dragend drop', function() {
                $(this).removeClass('is-dragover');
            })
            .on('drop', function(e) {
                const files = e.originalEvent.dataTransfer.files;
                const input = $(this).find('.custom-file-drop');
                self.showFiles(files, input, self.propertyName)
            });
        },
        addDomainToImage(url) { // return url
            let resultUrl
            if (url.indexOf('data:image/') === 0 || url.indexOf('http') === 0) {
                resultUrl = url
            } else {
                resultUrl = this.$domain + url
            }
            return resultUrl
        },
        handelShowBtnRemoveSingleImage() {
            if ( (this.defaultSrcImage && this.form[this.propertyName] != this.defaultSrcImage) && !this.required ) {
                this.showBtnRemoveSingleImage = true
            } else if ( (this.defaultSrcImage && this.form[this.propertyName] == this.defaultSrcImage) && !this.required ) {
                this.showBtnRemoveSingleImage = false

            } else if (!this.required && !this.defaultSrcImage) {
                this.showBtnRemoveSingleImage = true
            } else {
                this.showBtnRemoveSingleImage = false
            }
        },

        handelShowDefaultSrcImage() {
            this.$nextTick(() => {
                if (this.defaultSrcImage) {
                    if (this.form[this.propertyName] == '') {
                        this.form[this.propertyName] = this.defaultSrcImage
                    }
                }
            })
        }
    },

    computed: {
        formError() {
            return this.pathError != null ? this.pathError : this.propertyName
        }
    },

    watch: {
        form: {
            handler(newValForm) {
                this.handelShowBtnRemoveSingleImage()
                this.handelShowDefaultSrcImage()
            },
            deep: true
        }
    },
    mounted() {
        console.log('propertyArrayRecursive '  + this.propertyArrayRecursive.logo)
        this.handelShowBtnRemoveSingleImage()
        this.handelShowDefaultSrcImage()
        this.handelDropImages()
    }
}
</script>
