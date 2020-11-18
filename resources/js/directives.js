import Vue from 'vue'
import ClickOutside from 'vue-click-outside'

Vue.directive('click-outside', ClickOutside)



Vue.directive('selectSearchColumn', {
    inserted(el, binding, vnode) {
    $(el).select2({
            closeOnSelect: false,
            dropdownAutoWidth: true
        })
        .on("select2:select", e => {
            const selected = e.params.data.id
            if (selected === 'all') {
                vnode.context.tableData.searchColumnSelected = ['all']
            } else {
                const columns = $(el).val()
                const index = columns.indexOf('all')
                if (index != -1) {
                    columns.splice(index, 1)
                }
                vnode.context.tableData.searchColumnSelected = columns
            }
        })
        .on("select2:unselect", () => {
            const columns = $(el).val()
            if (!columns.length) {
                vnode.context.tableData.searchColumnSelected = ['all']
            } else {
                vnode.context.tableData.searchColumnSelected = columns
            }
        })
        .bind(this);
    },
    update(el) {
        $(el).trigger("change");
    }
})

Vue.directive('selectcolumn', {
    inserted(el, binding, vnode) {
    $(el).select2({
            closeOnSelect: false,
            dropdownAutoWidth: true
        })
        .on("select2:select", () => {
            vnode.context.tableData.columns = $(el).val();
            // vnode.context.$emit('getData');
        })
        .on("select2:unselect", () => {
            vnode.context.tableData.columns = $(el).val();
        })
        .bind(this);
    },
    update(el) {
        $(el).trigger("change");
    }
})

Vue.directive('selectviewtableclass', {
    inserted(el, binding, vnode) {
        $(el).select2({
            closeOnSelect: false,
            dropdownAutoWidth: true
        })
        .on("select2:select", () => {
            vnode.context.tableData.filter.viewTable = $(el).val();
            // vnode.context.$emit('getData');
        })
        .on("select2:unselect", () => {
            vnode.context.tableData.filter.viewTable = $(el).val();
        })
        .bind(this);
    },
    update(el) {
        $(el).trigger("change");
    }
})

Vue.directive('selectcolumnopen', {
    inserted(el) {
        $(el).click(function() {
            $(el)
            .find("> select")
            .select2("open");
        });
    }
})


Vue.directive('select2address', {
    inserted(el, binding, vnode) {
        $(el).select2({
            closeOnSelect: true,
            dropdownAutoWidth: true,
            dir: 'rtl'
        })
        .on("select2:select", () => {
            vnode.context.form.address = $(el).val();
        })
        // .on("select2:unselect", () => {
        //     vnode.context.tableData.filter.viewTable = $(el).val();
        // })
        .bind(this);
    },
    update(el) {
        $(el).trigger("change");
    }
})

Vue.directive('read-more', {
    inserted(el, binding) {
        const loopGetHtml =  setInterval(() => {
            const $this = $(el);
            const text = $this.html().trim().replace(/ {1, }/g, '');
            let event = binding.arg,
                value = binding.value,
                textBtnRead = value.textBtnRead,
                textBtnUnread = value.textBtnUnread,
                btn;
            if (text != '') {
                clearInterval(loopGetHtml);
                let len = window.parseInt(value.limit),
                    text = $this.html().trim().replace(/ {1, }/g, ''),
                    newText = text.slice(0, len);
                if ((text.length - len) >= 50) {
                    let contentText = $this.find('span.content-text').first(),
                        afterText = $this.attr('next-text');
                    $this.html('');
                    if (!contentText.length) {
                        contentText = $('<span class="content-text"></span>');
                        $this.prepend(contentText);
                    }
                    if ($this.attr('next-text')) {
                        contentText.html(newText + afterText);
                    } else {
                        if (event) {
                            btn = $this.find('.btn-read').first();
                            if (!btn.length) {
                                btn = $('<button class="btn-read btn btn-link has-limit">' + textBtnRead + '</button>');
                                contentText.html(newText);
                                $this.append(btn);
                            }
                        } else {
                            contentText.html(newText + '...');
                        }
                    }
                }
                $this.on('click', '.btn-read', function () {
                    if (event === 'toggle') {
                        if ($(this).hasClass('has-limit')) {
                            $(this).removeClass('has-limit');
                            $(this).html(textBtnUnread);
                            $this.find('.content-text').html(text);
                        } else {
                            $(this).addClass('has-limit');
                            $(this).html(textBtnRead);
                            $this.find('.content-text').html(newText);
                        }
                    } else if (event === 'show') {
                        if ($(this).hasClass('has-limit')) {
                            $(this).removeClass('has-limit');
                            $(this).hide();
                            $this.find('.content-text').html(text);
                        }
                    }
                });
            }
        }, 200)
    }
})



/* link whatsapp */


const linkWhatsApp = 'https://api.whatsapp.com/send?phone='

Vue.directive('link-whatsapp', {
    inserted(el, binding) {
        let number = binding.value
        if (number != null) {
            if (number.substr(0, 2) != '+2') {
                number = '+2' + number
            }
            el.href = linkWhatsApp + number
        }
    },
    update(el, binding) {
        let number = binding.value
        if (number != null) {
            if (number.substr(0, 2) != '+2') {
                number = '+2' + number
            }
            el.href = linkWhatsApp + number
        }
    },
})

// ===============================================================
Vue.directive('send-whatsapp', {
    inserted(el, binding) {
        let number = binding.value.phone
        let text = binding.value.text
        if (number != '' && number != null) {
            if (number.substr(0, 2) != '+2') {
                number = '+2' + number
            }
            el.href = linkWhatsApp + number + '&text=' + encodeURIComponent(text)
        }
    },
    update(el, binding) {
        let number = binding.value.phone
        let text = binding.value.text
        if (typeof number == 'string' && number != '' && number != null) {
            if (number.substr(0, 2) != '+2') {
                number = '+2' + number
            }
            el.href = linkWhatsApp + number + '&text=' + encodeURIComponent(text)
        }
    },
})


// ===============================================================
Vue.directive('html-lines', {
    inserted(el, binding) {
        let value = binding.value
        el.innerHTML = value != null && value != '' ? value.replace(/[\n\t]/g, '<br>') : ''
    }
})
