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

// const $ = require('admin-lte/plugins/jquery/jquery.min');
// global.$ = global.jQuery = $;
window.$ = window.jQuery = require('admin-lte/plugins/jquery/jquery.min');

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
require('admin-lte/plugins/datatables-rowgroup/js/rowGroup.bootstrap4.min')

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

require("select2")
// require("select2/dist/css/select2.min.css")
// datepicker
require("bootstrap-datepicker/dist/js/bootstrap-datepicker.min");
require("bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min")
require("bootstrap-datepicker/dist/locales/bootstrap-datepicker.eu.min")
require("bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.min.css")
require('eonasdan-bootstrap-datetimepicker')
const adminlte = require('admin-lte');

const routes = require('../public/js/fos_js_routes.json');
import Routing from '../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js';

Routing.setRoutingData(routes);


$(function () {
    const appLocale = $('#appLocale').val()

    $('body').on('focus',".datepicker", function(){
        $(this).datepicker({
            format: "yyyy-mm-dd",
            startView: "month",
            minViewMode: "month",
            language: "eu",
            autoclose: true
        });
    });

    $('body').on('focus',".datetimepicker", function(){
        $(this).datetimepicker({
            inline: true,
            locale: "eu",
            sideBySide: true
        });
    });

    $('body').on('DOMNodeInserted', 'select', function () {
        $(this).select2({ width: '100%' });
    });

    $('.select2').select2({ width: '100%' });

    $('#cmbKontratua').on('select2:select', function (e) {
        const data = e.params.data;
        const url = Routing.generate('api_contracts_get_item',{ 'id': data.id })

        $('#notification_lote').empty();
        $('#notification_lote').select2("destroy");
        $('#notification_lote').select2({
            ajax: {
                url: url,
                dataType: 'json',
                processResults: function (data) {
                    return {
                        results: $.map(data.lotes, function(obj) {
                            return { id: obj.id, text: obj.name };
                        })
                    };
                }
            }
        });


    });

    $('.btnModalNewLote').on('click', function () {
        const $kontratuid = $(this).data('kontratuid');
        const url = Routing.generate('kontratua_lote_new', { kontratuid: $kontratuid });
        $.get(url, function (data) {
            $(".divLoteCrud").html(data);
            $('.select2').select2({ width: '100%' });
            $('#modalLoteCrud').modal();
        });
    });

    $('.btnLoteEditInModal').on('click', function () {
        const $miid = $(this).data('id');
        const url = Routing.generate('kontratua_lote_edit', {'id': $miid});
        $.get(url, function (data) {
            $(".divLoteCrud").html(data);
            $('.select2').select2({ width: '100%' });
            $('#modalLoteCrud').modal();
        });
    });

    $("#btnFrmFinderSubmit").on("click", function () {
        $("#frmFinder").submit();
    });
    $('#btnSaveButton').on('click', function () {
        $('#crudSubmitButton').trigger('click');
    });

    $('.btnModalSaveLoteButton').on('click', function (e) {
        let isValid = true;
        let testua='';

        if ($('#kontratua_lote_name').val() === '') {
            isValid = false;
            testua = '<p class="text-danger">Lote izena beharrezkoa da.</p>'
        }
        if($('#kontratua_lote_kontratista').val() === '') {
            isValid = false;
            testua += '<p class="text-danger">Kontratista bat aukeratzea beharrezkoa da.</p>'
        }
        if($('#kontratua_lote_sinadura').val() === '') {
            isValid = false;
            testua += '<p class="text-danger">Sinadura data bat aukeratzea beharrezkoa da.</p>'
        }
        if($('#kontratua_lote_iraupena').val() === '') {
            isValid = false;
            testua += '<p class="text-danger">Iraupena zehaztea beharrezkoa da.</p>'
        }
        if($('#kontratua_lote_luzapena').val() === '') {
            isValid = false;
            testua += '<p class="text-danger">Luzapena zehaztea beharrezkoa da.</p>'
        }

        if ( isValid === true ) {
            console.log('Validating ok. submitting.')
            $('#form_lote_new').submit();
        } else {
            console.log('Ez da balidatua izan.')
            Swal.fire({
                title: 'Zuzenedu ondoko akatsak',
                html: testua,
                icon: 'warning'
            })
        }
    });

    $('.btnDeleteButton').on('click', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Ziur zaude?',
            text: "Onartuz gero ezingo da atzera egin!",
            icon: 'warning',
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

    $('#dtNoSorting').DataTable({
        language: appLocale === "eu" ? dtLocaleEu : dtLocaleEs,
        autoWidth: false,
        lengthChange: true,
        info: true,
        ordering: false,
        bSort: false,
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

    $('#myDatatable2').DataTable({
        language: appLocale === "eu" ? dtLocaleEu : dtLocaleEs,
        columnDefs: [
            { targets: 2, visible: false },
            { targets: 3, visible: false },
            { targets: 4, visible: false },
            { targets: 7, visible: false },
            { targets: 8, visible: false },
            { targets: 11, visible: false },
        ],
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

    $('#myDatatable3').DataTable( {
        order: [[2, 'asc']],
        rowGroup: {
            dataSrc: 0
        },
        columnDefs: [ {
            targets: [ 0],
            visible: false
        } ]
    });

});
