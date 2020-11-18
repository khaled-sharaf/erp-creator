import router from './router/index'

$(function () {


    // show more data in tr list -- in datatable (filterd columns)
    $(document).on("click", ".btn-show-more-row", function() {
        let trData = $(this)
          .parents("tr")
          .next("tr");
          trData.toggle();

        if (!$(this).hasClass("active")) {
          $(this).addClass("active");
          $(this)
            .find("i")
            .removeClass("fa-plus")
            .addClass("fa-minus");
        } else {
          $(this).removeClass("active");
          $(this)
            .find("i")
            .removeClass("fa-minus")
            .addClass("fa-plus");
        }
      });
    /*000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000*/

    $(document).on("click", ".link-router-in-table", function(e) {
        e.preventDefault();
        let $this = $(this),
            routerName = $this.attr('data-name'),
            routerParams = $this.attr('data-params');

        if (routerName != null && routerParams != null) {
            routerParams = JSON.parse(routerParams);
            router.push({name: routerName, params: routerParams});
        } else {
            console.error('Error router link => data-name is required, data-params is required in link attributes');
        }
    });

    /*000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000*/

    // show old data in date more in any table
    let showOldDate = true;
    $(document).on('mouseenter mouseleave', '.tr-table-data span[data-old-format]', function () {
        let oldFormate = $(this).attr('data-old-format'),
            newFormate = $(this).attr('data-new-format');
        showOldDate = !showOldDate;
        showOldDate ? $(this).text(oldFormate) : $(this).text(newFormate);
    });



    /*000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000*/


    // add class open menu to menu when after reload page if has item contains class active
    function addClassActiveToParentInSidebar(linkActive) {
        let parentTagMenu = linkActive.parents('.nav-item.has-treeview');
        parentTagMenu.addClass('menu-open');
        parentTagMenu.children('a.nav-link').addClass('active');
    }
    let linkActive = $('#nav-sidebar-global .nav-item a.nav-link.active');
    addClassActiveToParentInSidebar(linkActive);

    $('#nav-sidebar-global .nav-item a.nav-link').not('[href="#"]').on('click', function () {
        let link = $(this);
        let parentTagMenu = link.parents('.nav-item');
        parentTagMenu.children('a.nav-link').addClass('active');
        parentTagMenu.siblings('.nav-item.has-treeview').children('a.nav-link').removeClass('active');
    });
    $('.navbar-nav .link-home').on('click', function () {
        $('#nav-sidebar-global .nav-item a.nav-link').parents('.nav-item.has-treeview').children('a.nav-link').removeClass('active');
    });

    /*000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000*/
    $('.read-more').each(function () {
        const loopGetHtml =  setInterval(() => {
            const text = $(this).html().trim().replace(/ {1, }/g, '');
            let event = $(this).attr('event-type'),
                textBtnRead = $(this).attr('text-btn-read'),
                textBtnUnread = $(this).attr('text-btn-unread'),
                btn;

            if (text != '') {
                clearInterval(loopGetHtml);
                let len = window.parseInt($(this).attr('limit-char')),
                    text = $(this).html().trim().replace(/ {1, }/g, ''),
                    newText = text.slice(0, len);
                if ((text.length - len) >= 50) {
                    let contentText = $(this).find('span.content-text').first(),
                        afterText = $(this).attr('next-text');
                    $(this).html('');
                    if (!contentText.length) {
                        contentText = $('<span class="content-text"></span>');
                        $(this).prepend(contentText);
                    }
                    if ($(this).attr('next-text')) {
                        contentText.html(newText + afterText);
                    } else {
                        if ($(this).attr('event-type')) {
                            event = $(this).attr('event-type');
                            textBtnRead = $(this).attr('text-btn-read');
                            textBtnUnread = $(this).attr('text-btn-unread');
                            btn = $(this).find('.btn-read').first();
                            if (!btn.length) {
                                btn = $('<button class="btn-read btn btn-link has-limit">' + textBtnRead + '</button>');
                                contentText.html(newText);
                                $(this).append(btn);
                            }
                        } else {
                            contentText.html(newText + '...');
                        }
                    }
                }
                $(this).on('click', '.btn-read', function () {
                    if (event === 'toggle') {
                        if ($(this).hasClass('has-limit')) {
                            $(this).removeClass('has-limit');
                            $(this).html(textBtnUnread);
                            $(this).parent('.read-more').find('.content-text').html(text);
                        } else {
                            $(this).addClass('has-limit');
                            $(this).html(textBtnRead);
                            $(this).parent('.read-more').find('.content-text').html(newText);

                        }
                    } else if (event === 'show') {
                        if ($(this).hasClass('has-limit')) {
                            $(this).removeClass('has-limit');
                            $(this).hide();
                            $(this).parent('.read-more').find('.content-text').html(text);
                        }
                    }
                });
            }
        }, 1000)

    });

    /*000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000*/


});
