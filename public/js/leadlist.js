/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/leadlist.js ***!
  \**********************************/
window.setTimeout(function () {
  if (teamids.length) {
    teamids.forEach(function (teamid) {// Echo.private(`addleadrow.${teamid}`)
      //     .listen('LeadCreated', (e) => {
      //
      //         $.ajax({
      //             url: BASE_URL + 'admin/lead/getactions/' + e.id,
      //             method: 'get',
      //
      //         }).done(function (d) {
      //
      //             leadlisttable.row.add([
      //                 e.id_with_trash,
      //                 e.formatted_name,
      //                 e.email,
      //                 e.phone,
      //                 e.brand_name,
      //                 e.package,
      //                 e.assigned_to,
      //                 e.formatted_status,
      //                 e.status,
      //                 e.read,
      //                 e.last_updated_at,
      //                 d.actions
      //             ]).draw(true);
      //
      //             $('[for="fnew"] .badge-up').html(0).addClass('d-none');
      //             $('[for="fassigned"] .badge-up').html(0).addClass('d-none');
      //             $('[for="fInvoiced"] .badge-up').html(0).addClass('d-none');
      //             $('[for="fPaid"] .badge-up').html(0).addClass('d-none');
      //             leadlisttable.rows().every(function (e) {
      //                 var row1 = this;
      //                 var data = row1.data();
      //                 if (data[9] == 0) {
      //                     $('[for="f' + data[8] + '"] .badge-up').removeClass('d-none');
      //                     var c = $('[for="f' + data[8] + '"] .badge-up').html();
      //                     c = parseInt(c) + 1;
      //                     $('[for="f' + data[8] + '"] .badge-up').html(c);
      //                 }
      //
      //             });
      //
      //
      //         });
      //
      //
      //     });
      // Echo.private(`updateleadrow.${teamid}`)
      //     .listen('LeadUpdated', (e) => {
      //
      //         $.ajax({
      //             url: BASE_URL + 'admin/lead/getactions/' + e.id,
      //             method: 'get',
      //
      //         }).done(function (d) {
      //
      //             var row = leadlisttable.row('#row-' + e.id);
      //
      //             if (e.read == 0) {
      //                 $('#row-' + e.id).addClass('unread');
      //             }
      //
      //             var updateddata = [
      //                 e.id_with_trash,
      //                 e.formatted_name,
      //                 e.email,
      //                 e.phone,
      //                 e.brand_name,
      //                 e.package,
      //                 e.assigned_to,
      //                 e.formatted_status,
      //                 e.status,
      //                 e.read,
      //                 e.last_updated_at,
      //                 d.actions
      //             ];
      //
      //             row.data(updateddata).draw(true);
      //
      //             $('[for="fnew"] .badge-up').html(0).addClass('d-none');
      //             $('[for="fassigned"] .badge-up').html(0).addClass('d-none');
      //             $('[for="fInvoiced"] .badge-up').html(0).addClass('d-none');
      //             $('[for="fPaid"] .badge-up').html(0).addClass('d-none');
      //             leadlisttable.rows().every(function (e) {
      //                 var row1 = this;
      //                 var data = row1.data();
      //                 if (data[9] == 0) {
      //                     $('[for="f' + data[8] + '"] .badge-up').removeClass('d-none');
      //                     var c = $('[for="f' + data[8] + '"] .badge-up').html();
      //                     c = parseInt(c) + 1;
      //                     $('[for="f' + data[8] + '"] .badge-up').html(c);
      //                 }
      //
      //             });
      //
      //         });
      //
      //
      //     });
    });
  }
}, 8000);
/******/ })()
;