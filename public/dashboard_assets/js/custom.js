/*
=========================================
|                                       |
|           Feather Icon                |
|                                       |
=========================================
*/
feather.replace()
    /*
    =========================================
    |                                       |
    |           Scroll To Top               |
    |                                       |
    =========================================
    */

$(".scrollTop").click(function() {
    $("html, body").animate({ scrollTop: 0 });
});

$(
    ".navbar .dropdown.notification-dropdown > .dropdown-menu, .navbar .dropdown.message-dropdown > .dropdown-menu "
).click(function(e) {
    e.stopPropagation();
});

/*
=========================================
|                                       |
|       Expand Sidebar Link             |
|                                       |
=========================================
*/
var url = window.location.href;
// passes on every "a" tag
$("#sidebar a").each(function() {
    // checks if its the same on the address bar
    if (url == this.href) {
        if (
            $(this)
            .closest("li")
            .addClass("active")
        ) {
            // checks for parent link to highlight
            var data = $(this).parent().parent().find("a");
            // console.log()

            if ($(data[0]).attr("id") != "dashboard") {
                data.parent().parent().parent().addClass("active");
                data.parent().parent().siblings('a').attr("aria-expanded", "true");
                data.parent().parent().siblings('a').addClass("collapsed show");
                data.parent().parent().addClass("show");

            } else {
                $(this).addClass("active");
            }
        }
    }
});
/*
=========================================
|                                       |
|       Multi-Check checkbox            |
|                                       |
=========================================
*/

function checkall(clickchk, relChkbox) {
    var checker = $("#" + clickchk);
    var multichk = $("." + relChkbox);

    checker.click(function() {
        multichk.prop("checked", $(this).prop("checked"));
    });
}

/*
=========================================
|                                       |
|           DataTables                  |
|   This will reflects in all Table     |
|                                       |
=========================================
*/
var buttonCommon = {
    exportOptions: {
        format: {
            body: function(data, row, column, node) {
                return row(0).remove();
            }
        }
    }
};
$.extend(true, $.fn.dataTable.defaults, {
    pageLength: 10,
    pagingType: "full_numbers",
    dom: 'Blfrtip',
    buttons: [
        //Options and exports dropdowns
        {
            extend: 'collection',
            className: 'exportButton',
            text: 'Export Data',
            header: false,
            buttons: [{
                    extend: 'copy',
                    exportOptions: {
                        modifier: {
                            page: 'all',
                            search: 'none'
                        },
                    },
                    'header': false,
                    'title': '',
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        modifier: {
                            page: 'all',
                            search: 'none'
                        }
                    },
                    'header': false,
                    'title': '',
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        modifier: {
                            page: 'all',
                            search: 'none'
                        }
                    },
                    'header': false,
                    'title': '',
                },
                {
                    extend: 'pdf',
                    xportOptions: {
                        modifier: {
                            page: 'all',
                            search: 'none'
                        }
                    },
                    'header': false,
                    'title': '',
                },
                {
                    extend: 'print',
                    exportOptions: {
                        modifier: {
                            page: 'all',
                            search: 'none'
                        }
                    },
                    'header': false,
                    'title': '',
                }
            ]
        }
    ],
    lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
    ],
    initComplete: function() {
        $(".data-grid-export tr").first().addClass("notPrintable");
    }
});

/*
=========================================
|                                       |
|           MultiCheck                  |
|                                       |
=========================================
*/

/*
    This MultiCheck Function is recommanded for datatable
*/

// function multiCheck(tb_var) {
//     tb_var.on("change", ".chk-parent", function() {
//             var e = $(this)
//                 .closest("table")
//                 .find("td:first-child .child-chk"),
//                 a = $(this).is(":checked");
//             $(e).each(function() {
//                 a
//                     ?
//                     ($(this).prop("checked", !0),
//                         $(this)
//                         .closest("tr")
//                         .addClass("active")) :
//                     ($(this).prop("checked", !1),
//                         $(this)
//                         .closest("tr")
//                         .removeClass("active"));
//             });
//         }),
//         tb_var.on("change", "tbody tr .new-control", function() {
//             $(this)
//                 .parents("tr")
//                 .toggleClass("active");
//         });
// }

/*
=========================================
|                                       |
|           MultiCheck                  |
|                                       |
=========================================
*/

// function checkall(clickchk, relChkbox) {
//     var checker = $("#" + clickchk);
//     var multichk = $("." + relChkbox);

//     checker.click(function() {
//         multichk.prop("checked", $(this).prop("checked"));
//     });
// }

/*
=========================================
|                                       |
|               Tooltips                |
|                                       |
=========================================
*/

$(".bs-tooltip").tooltip();

/*
=========================================
|                                       |
|               Popovers                |
|                                       |
=========================================
*/

$(".bs-popover").popover();

/*
================================================
|                                              |
|               Rounded Tooltip                |
|                                              |
================================================
*/

// $(".t-dot").tooltip({
//     template: '<div class="tooltip status rounded-tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
// });

/*
================================================
|            IE VERSION Dector                 |
================================================
*/

function GetIEVersion() {
    var sAgent = window.navigator.userAgent;
    var Idx = sAgent.indexOf("MSIE");

    // If IE, return version number.
    if (Idx > 0)
        return parseInt(sAgent.substring(Idx + 5, sAgent.indexOf(".", Idx)));
    // If IE 11 then look for Updated user agent string.
    else if (!!navigator.userAgent.match(/Trident\/7\./)) return 11;
    else return 0; //It is not IE
}

/*
================================================
|                                              |
|               Select2                        |
|                                              |
================================================
*/

$(".select2").select2({
    // placeholder: "Alle",
    // allowClear: true,
});

/*
================================================
|                                              |
|              Flat-DatePicker                     |
|                                              |
================================================
*/

// var f1 = flatpickr(document.getElementById("date_picker"), {
//     dateFormat: "d.m.Y",
//     minDate: "today"
//         // defaultDate: new Date(),
// });
// var f4 = flatpickr(document.getElementById("time_picker"), {
//     enableTime: true,
//     noCalendar: true
//         // dateFormat: "H:i"
//         // defaultDate: "13:45"
// });
/*
================================================
|                                              |
|              Tooltip                         |
|                                              |
================================================
*/
$(function() {
    $('[data-toggle="tooltip"]').tooltip();
});
/*
=================================================================
|                                                               |
|         Ask Befor Delete                                      |
|                                                               |
|                                                               |
=================================================================
*/

// function deleteData(e) {
//     event.preventDefault();
//     const swalWithBootstrapButtons = swal.mixin({
//         confirmButtonClass: "btn btn-success btn-rounded",
//         cancelButtonClass: "btn btn-danger btn-rounded mr-3",
//         buttonsStyling: false
//     });
//     new swalWithBootstrapButtons({
//         title: "Bist Du Sicher?",
//         text: "Sie Können Dies Nicht Rückgängig Machen!",
//         type: "warning",
//         showCancelButton: true,
//         confirmButtonText: "Ja, löschen Sie es.",
//         cancelButtonText: "Kein Abbrechen!",
//         reverseButtons: true,
//         padding: "2em"
//     }).then(function(result) {
//         if (result.value) {
//             //  swal({
//             //       title: '@lang("call_tasks.blocked")',
//             //       text: '@lang("call_tasks.blocked") @lang("call_tasks.successfully")',
//             //       type: 'success',
//             //       padding: '2em'
//             //  });
//             //  e.submit();
//             // console.log();
//             var id = $(e).attr("id");
//             $("form#" + id).submit();
//             //  return true;
//         } else if (
//             // Read more about handling dismissals
//             result.dismiss === swal.DismissReason.cancel
//         ) {
//             swalWithBootstrapButtons(
//                 "Abgebrochen",
//                 "Ihre Daten Sind Sicher :)",
//                 "error"
//             );
//             return false;
//         }
//     });
// }
/**
 * Delete Current Data
 *
 */
// function deleteThisData(e) {
//     event.preventDefault();
//     const swalWithBootstrapButtons = swal.mixin({
//         confirmButtonClass: "btn btn-success btn-rounded",
//         cancelButtonClass: "btn btn-danger btn-rounded mr-3",
//         buttonsStyling: false
//     });
//     new swalWithBootstrapButtons({
//         title: "Bist Du Sicher?",
//         text: "Sie Können Dies Nicht Rückgängig Machen!",
//         type: "warning",
//         showCancelButton: true,
//         confirmButtonText: "Ja, löschen Sie es.",
//         cancelButtonText: "Kein Abbrechen!",
//         reverseButtons: true,
//         padding: "2em"
//     }).then(function(result) {
//         if (result.value) {
//             //  swal({
//             //       title: '@lang("call_tasks.blocked")',
//             //       text: '@lang("call_tasks.blocked") @lang("call_tasks.successfully")',
//             //       type: 'success',
//             //       padding: '2em'
//             //  });
//             e.submit();
//             return true;
//         } else if (
//             // Read more about handling dismissals
//             result.dismiss === swal.DismissReason.cancel
//         ) {
//             swalWithBootstrapButtons(
//                 "Abgebrochen",
//                 "Ihre Daten Sind Sicher :)",
//                 "error"
//             );
//             return false;
//         }
//     });
// }

/*
=================================================================
|                                                               |
|         Ask Befor Form submit If any error it will popup      |
|         an alert and focus on field                           |
|                                                               |
|                                                               |
=================================================================
*/
// function checkRequiredEntries(form) {
//     // console.log(form);
//     var marker = 0;
//     $('#' + form).find('input').each(function() {
//         if ($(this).prop('required')) {
//             if ($(this).val() == "") {
//                 marker = 1;
//                 alert("Füllen Sie zuerst das gewünschte Feld aus");
//                 $(this).focus();
//                 return false;
//             }
//         }
//     });
//     if (marker) {
//         return false;
//     }
// }