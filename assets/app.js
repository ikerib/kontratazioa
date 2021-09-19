/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

const $ = require('admin-lte/plugins/jquery/jquery.min');
global.$ = global.jQuery = $;

const ui = require('admin-lte/plugins/jquery-ui/jquery-ui.min')
require('admin-lte/plugins/bootstrap/js/bootstrap.bundle.min');

$.fn.dataTable = $.fn.DataTable = global.DataTable = require('admin-lte/plugins/datatables/jquery.dataTables.min');
import 'admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min'
require( 'admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min');
require( 'admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min');

// const buttons = require('admin-lte/plugins/datatables-buttons/js/dataTables.buttons.min');
// import 'admin-lte/plugins/datatables-buttons/js/dataTables.buttons.min';
// require('admin-lte/plugins/datatables-buttons/js/dataTables.buttons.min')
//// const dtbtb = require('admin-lte/plugins/datatables-buttons/js/buttons.bootstrap4.min');
// import 'admin-lte/plugins/datatables-buttons/js/buttons.bootstrap4.min';
require( 'admin-lte/plugins/datatables-buttons/js/buttons.bootstrap4.min');
//// const zip = require('admin-lte/plugins/jszip/jszip.min');
//// const pdf = require('admin-lte/plugins/pdfmake/pdfmake.min');
//// const vfont = require('admin-lte/plugins/pdfmake/vfs_fonts');
//// const htm = require('admin-lte/plugins/datatables-buttons/js/buttons.html5.min');
////require('admin-lte/plugins/datatables-buttons/js/buttons.html5.min');
//import buttons from 'admin-lte/plugins/datatables-buttons/js/dataTables.buttons.min'
//// const print = require('admin-lte/plugins/datatables-buttons/js/buttons.print.min')
//import print from 'admin-lte/plugins/datatables-buttons/js/buttons.print.min';

//// const col = require('admin-lte/plugins/datatables-buttons/js/buttons.colVis.min');


window.JSZip = require( 'jszip' );
// require( 'datatables.net-bs4' );
// require( 'datatables.net-buttons-bs4' );
require( 'datatables.net-buttons/js/buttons.html5.js' );
require( 'datatables.net-buttons/js/buttons.print.js' );
// require( 'datatables.net-responsive-bs4' );
//
// pdfMake
var pdfMake = require('pdfmake/build/pdfmake.js');
var pdfFonts = require('pdfmake/build/vfs_fonts.js');
pdfMake.vfs = pdfFonts.pdfMake.vfs;


const adminlte = require('admin-lte');



$(function () {
    $('#btnSaveButton').on('click', function () {
        $('#crudSubmitButton').trigger('click');
    });

    $('#myDatatable').DataTable({
        "dom": 'Bfrtip',
        "autoWidth": false,
        "lengthChange": true,
        "info": true,
        "ordering": true,
        "paging": true,
        "responsive": true,
        "searching": true,
        "buttons": ["copy", "csv", "excel", "pdf"]
    });
        //
        // $('#myDatatable').DataTable(
        //     {
        //         dom: "<'row'<'col-10'r>><'row'<'col-5'l><'col-7 text-right'f>>" +
        //             "<'row'<'col-sm-12'B>><'row'<'col-sm-12't>><'row'<'col-5'i><'col-7'p>>",
        //         buttons: {
        //             dom: {
        //                 button: {
        //                     tag: 'button',
        //                     className: 'btn btn-sm'
        //                 }
        //             },
        //             buttons: [
        //                 {extend: "print", text: "<i class='fas fa-print'></i> Print", className: 'btn-primary'},
        //                 {
        //                     extend: "excelHtml5",
        //                     text: "<i class='far fa-file-excel'></i> Excel",
        //                     className: 'btn-primary'
        //                 },
        //                 {
        //                     extend: "pdfHtml5",
        //                     text: "<i class='far fa-file-pdf'></i> PDF",
        //                     className: 'btn-primary'
        //                 },
        //             ],
        //         }
        //     }
        // );

});
