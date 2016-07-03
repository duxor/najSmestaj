@extends('firmolog.master')
@section('container')
    <div class="box" style="border:none">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Kontakt</span>
                    <span class="info-box-number">1,410</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Rezervacije</span>
                    <span class="info-box-number">410</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-eye"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Posete</span>
                    <span class="info-box-number">13,648</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-heart"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Poželjnost</span>
                    <span class="info-box-number">93,139</span>
                </div>
            </div>
        </div>
    </div>

    {{---TRENUTNO-STANJE-SMJEŠTAJA::START--}}
    {{---$stanje=['slobodan','rezervisan','zauzet']--}}
    <div class="col-sm-7">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Status smeštaja</h3>
            </div>
            <div class="box-body no-padding">
                <table class="table text-center">
                    <tbody>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Naziv</th>
                            <th>Kapacitet</th>
                            <th style="width: 40px">Status</th>
                            <th>Datum promene</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td>1.</td>
                            <td>Soba Nina</td>
                            <td>2</td>
                            <td><span class="label label-success">Slobodan</span></td>
                            <td>10.11.2016.</td>
                            <td><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Soba Ultimate</td>
                            <td>3</td>
                            <td><span class="label label-warning">Rezervisan</span></td>
                            <td>10.11.2016.</td>
                            <td><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Soba Mileva</td>
                            <td>1</td>
                            <td><span class="label label-danger">Zauzet</span></td>
                            <td>10.11.2016.</td>
                            <td><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    {{---trenutno-stanje-smještaja::end--}}

    {{---ZARADA::START--}}
    <div class="col-sm-5">
        <div class="box box-solid bg-teal-gradient">
            <div class="box-header">
                <i class="fa fa-th"></i>
                <h3 class="box-title">Zarada</h3>
            </div>
            <div class="box-body border-radius-none">
                <div class="chart" id="line-chart" style="height: 250px;"></div>
            </div>
            <div class="box-footer no-border">
                <div class="row">
                    <div class="col-xs-3 text-center" style="border-right: 1px solid #f4f4f4">
                        <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60" data-fgColor="#39CCCC">
                        <div class="knob-label">Telefonska narudžba</div>
                    </div>
                    <div class="col-xs-3 text-center" style="border-right: 1px solid #f4f4f4">
                        <input type="text" class="knob" data-readonly="true" value="15" data-width="60" data-height="60" data-fgColor="#39CCCC">
                        <div class="knob-label">Mail narudžba</div>
                    </div>
                    <div class="col-xs-3 text-center" style="border-right: 1px solid #f4f4f4">
                        <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60" data-fgColor="#39CCCC">
                        <div class="knob-label">Na sajtu</div>
                    </div>
                    <div class="col-xs-3 text-center">
                        <input type="text" class="knob" data-readonly="true" value="5" data-width="60" data-height="60" data-fgColor="#39CCCC">
                        <div class="knob-label">Lično</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{---zarada::end--}}
@endsection
@section('end-script')
    <!-- jQuery Knob Chart -->
    <script src="/templejt/admin-lte-v233/plugins/knob/jquery.knob.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="/templejt/admin-lte-v233/plugins/morris/morris.min.js"></script>
    <script>
        /* jQueryKnob */
        $(".knob").knob();
        /* Morris.js Charts */
        // Sales chart

        var line = new Morris.Line({
            element: 'line-chart',
            resize: true,
            data: [
                {y: '2014 Q1', item1: 2666},
                {y: '2014 Q2', item1: 2778},
                {y: '2014 Q3', item1: 4912},
                {y: '2014 Q4', item1: 3767},
                {y: '2015 Q1', item1: 6810},
                {y: '2015 Q2', item1: 5670},
                {y: '2015 Q3', item1: 4820},
                {y: '2015 Q4', item1: 15073},
                {y: '2016 Q1', item1: 10687},
                {y: '2016 Q2', item1: 8432}
            ],
            xkey: 'y',
            ykeys: ['item1'],
            labels: ['Item 1'],
            lineColors: ['#efefef'],
            lineWidth: 2,
            hideHover: 'auto',
            gridTextColor: "#fff",
            gridStrokeWidth: 0.4,
            pointSize: 4,
            pointStrokeColors: ["#efefef"],
            gridLineColor: "#efefef",
            gridTextFamily: "Open Sans",
            gridTextSize: 10
        });
    </script>
@endsection
