/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');

const $ = require('admin-lte/plugins/jquery/jquery.min');
global.$ = global.jQuery = $;

const ui = require('admin-lte/plugins/jquery-ui/jquery-ui.min')
require('admin-lte/plugins/bootstrap/js/bootstrap.bundle.min');

// Datatables
$.fn.dataTable = $.fn.DataTable = global.DataTable = require('admin-lte/plugins/datatables/jquery.dataTables.min');
import 'admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min'
require( 'admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min');
require( 'admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min');
require( 'admin-lte/plugins/datatables-buttons/js/buttons.bootstrap4.min');
require('admin-lte/plugins/datatables-buttons/js/buttons.print.min');
require('admin-lte/plugins/datatables-buttons/js/buttons.colVis.min');
window.JSZip = require( 'jszip' );
require( 'datatables.net-buttons/js/buttons.html5.js' );
require( 'datatables.net-buttons/js/buttons.print.js' );
// pdfMake
const pdfMake = require('pdfmake/build/pdfmake.js');
const pdfFonts = require('pdfmake/build/vfs_fonts.js');
pdfMake.vfs = pdfFonts.pdfMake.vfs;
import * as dtLocaleEu from './lib/datatables/locales/eu.json';
import * as dtLocaleEs from './lib/datatables/locales/es.json';
import Swal from 'sweetalert2'

const adminlte = require('admin-lte');

$(function () {
    $('#btnSaveButton').on('click', function () {
        $('#crudSubmitButton').trigger('click');
    });

    $('.btnDeleteButton').on('click', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Ziur zaude?',
            text: "Onartuz gero ezingo da atzera egin!",
            icon: 'Kontuz',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Bai, ezabatu'
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).closest('form').submit();
            }
        })
    });

    const appLocale = $('#appLocale').val()


    // $('#myDatatable').DataTable({
    //     language: appLocale === "eu" ? dtLocaleEu : dtLocaleEs,
    //     "dom": 'Bfrtip',
    //     "autoWidth": false,
    //     "lengthChange": true,
    //     "info": true,
    //     "ordering": true,
    //     "paging": true,
    //     "responsive": true,
    //     "searching": true,
    //     "buttons": ["copy", "csv", "excel", "pdf", "print","colvis"]
    // });

        $('#myDatatable').DataTable({
            language: appLocale === "eu" ? dtLocaleEu : dtLocaleEs,
            autoWidth: false,
            lengthChange: true,
            info: true,
            ordering: true,
            paging: true,
            responsive: true,
            searching: true,
            dom: "<'row'<'col-10'r>><'row'<'col-5'l><'col-7 text-right'f>>" +
                 "<'row'<'col-sm-12'B>><'row'<'col-sm-12't>><'row'<'col-5'i><'col-7'p>>",
            buttons: {
                dom: {
                    button: {
                        tag: 'button',
                        className: 'btn btn-sm'
                    }
                },
                buttons: [
                    {
                        extend: "print",
                        text: "<i class='fas fa-print'></i> Print",
                        className: 'btn-outline-primary btn-xs'
                    },
                    {
                        extend: "excelHtml5",
                        text: "<i class='far fa-file-excel'></i> Excel",
                        className: 'btn-outline-primary btn-xs'
                    },
                    {
                        extend: "pdfHtml5",
                        text: "<i class='far fa-file-pdf'></i> PDF",
                        className: 'btn-outline-primary btn-xs'
                    },
                    {
                        extend: "csvHtml5",
                        text: "<i class='fas fa-file-csv'></i> CSV",
                        className: 'btn-outline-primary btn-xs'
                    },
                    {
                        extend: "colvis",
                        className: 'btn-outline-primary btn-xs'
                    }
                ],
            }}
        );

});