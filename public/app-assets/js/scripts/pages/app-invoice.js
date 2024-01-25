/*=========================================================================================
    File Name: app-invoice.js
    Description: app-invoice Javascripts
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
   Version: 1.0
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
$(function () {
    'use strict';

    var applyChangesBtn = $('.btn-apply-changes'),
        discount,
        price_input,
        item_price,
        tax1,
        tax2,
        discountInput,
        tax1Input,
        tax2Input,
        sourceItem = $('.source-item'),
        date = new Date(),
        datepicker = $('.date-picker'),
        dueDate = $('.due-date-picker'),
        select2 = $('.invoiceto'),
        select2sales = $('.salesperson'),
        select2leadsource = $('.leadsource'),
        countrySelect = $('#customer-country'),
        btnAddNewItem = $('.btn-add-new '),
        adminDetails = {
            'App Design': 'Designed UI kit & app pages.',
            'App Customization': 'Customization & Bug Fixes.',
            'ABC Template': 'Bootstrap 4 admin template.',
            'App Development': 'Native App Development.'
        };

    // init date picker
    if (datepicker.length) {
        datepicker.each(function () {
            $(this).flatpickr({
                //  defaultDate: date
            });
        });
    }

    if (dueDate.length) {
        dueDate.flatpickr({
            //  defaultDate: new Date(date.getFullYear(), date.getMonth(), date.getDate() + 5)
        });
    }

    // Country Select2
    if (countrySelect.length) {
        countrySelect.select2({
            placeholder: 'Select country',
            dropdownParent: countrySelect.parent()
        });
    }

    // Close select2 on modal open
    // $(document).on('click', '.add-new-customer', function () {
    //   select2.select2('close');
    // });

    // Select2
    if (select2.length) {
        select2.select2({
            placeholder: 'Select Lead',
            dropdownParent: $('.invoice-customer')
        });


        // select2.on('change', function () {
        //   var $this = $(this),
        //     renderDetails =
        //       '<div class="customer-details mt-1">' +
        //       '<p class="mb-25">' +
        //       customerDetails[$this.val()].name +
        //       '</p>' +
        //       '<p class="mb-25">' +
        //       customerDetails[$this.val()].company +
        //       '</p>' +
        //       '<p class="mb-25">' +
        //       customerDetails[$this.val()].address +
        //       '</p>' +
        //       '<p class="mb-25">' +
        //       customerDetails[$this.val()].country +
        //       '</p>' +
        //       '<p class="mb-0">' +
        //       customerDetails[$this.val()].tel +
        //       '</p>' +
        //       '<p class="mb-0">' +
        //       customerDetails[$this.val()].email +
        //       '</p>' +
        //       '</div>';
        //   $('.row-bill-to').find('.customer-details').remove();
        //   $('.row-bill-to').find('.col-bill-to').append(renderDetails);
        // });

        // select2.on('select2:open', function () {
        //   if (!$(document).find('.add-new-customer').length) {
        //     $(document)
        //       .find('.select2-results__options')
        //       .before(
        //         '<div class="add-new-customer btn btn-flat-success cursor-pointer rounded-0 text-start mb-50 p-50 w-100" data-bs-toggle="modal" data-bs-target="#add-new-customer-sidebar">' +
        //           feather.icons['plus'].toSvg({ class: 'font-medium-1 me-50' }) +
        //           '<span class="align-middle">Add New Customer</span></div>'
        //       );
        //   }
        // });
    }
    if (select2sales.length) {
        select2sales.select2({
            placeholder: 'Select Agent',
            // dropdownParent: $('.select-sales')
        });
    }
    if (select2leadsource.length) {
        select2leadsource.select2({
            placeholder: 'Select Lead Source',
            // dropdownParent: $('.select-sales')
        });
    }


    // Repeater init
    if (sourceItem.length) {
        sourceItem.on('submit', function (e) {
            e.preventDefault();
        });
        sourceItem.repeater({
            show: function () {
                $(this).slideDown();
            },
            hide: function (e) {
                $(this).slideUp();
            }
        });
    }

    // Prevent dropdown from closing on tax change
    $(document).on('click', '.tax-select', function (e) {
        e.stopPropagation();
    });

    // On tax change update it's value
    function updateValue(listener, el) {
        listener.closest('.repeater-wrapper').find(el).text(listener.val());
    }

    // Apply item changes btn
    if (applyChangesBtn.length) {

    }

    // Item details select onchange
    $(document).on('change', '.item-details', function () {
        var $this = $(this),
            value = adminDetails[$this.val()];
        if ($this.next('textarea').length) {
            $this.next('textarea').val(value);
        } else {
            $this.after('<textarea class="form-control mt-2" rows="2">' + value + '</textarea>');
        }
    });
    if (btnAddNewItem.length) {
        btnAddNewItem.on('click', function () {
            if (feather) {
                // featherSVG();
                feather.replace({width: 14, height: 14});
            }
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    }
});
