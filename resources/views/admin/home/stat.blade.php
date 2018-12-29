@extends('admin.layouts.app')

@section("content")
    <form class="form-horizontal" method="GET" action="/adminpanel/year">
        <div class="box-body">
            <h1>
            ايجاد احصائية عن الموقع عن سنة معينة
            </h1>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label pull-right">ادخل السنة المراد الكشف عنا</label>

                <div class="col-sm-10">
                    <select name="year" class="form-control pull-left">
                        <?php
                        for($i=date("Y")-5;$i<=date("Y");$i++) {
                            $sel = ($i == date('Y')) ? 'selected' : '';
                            echo "<option value=".$i." ".$sel.">".date("Y", mktime(0,0,0,0,1,$i+1))."</option>"; // change This Line
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
            <button type="submit" class="btn btn-info pull-right" style="margin-top: -300px; margin-right: 180px">بحث</button>
        <!-- /.box-footer -->
    </form>
@endsection
