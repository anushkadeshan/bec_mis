<?php $__env->startSection('title',' Mobile App Dashboard'); ?>
<?php $__env->startSection('content'); ?>
    <div class="main-content">
        <div class="container-fluid">
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <h3 class="panel-title">Field Visits</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover" id="example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Duration</th>
                                <th>Start Location</th>
                                <th>End Location</th>
                                <th>Distance</th>
                                <th>Client</th>
                                <th>Purpose</th>
                                <th>Action</th>
                                <th>Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                function secondsToTime($seconds) {
                                    $dtF = new \DateTime('@0');
                                    $dtT = new \DateTime("@$seconds");
                                    return $dtF->diff($dtT)->format('%h hours, %i minutes and %s seconds');
                                }
                                function distVincenty($lat1, $lon1, $lat2, $lon2)
                                {
                                    $lat1 = deg2rad($lat1);
                                    $lat2 = deg2rad($lat2);
                                    $lon1 = deg2rad($lon1);
                                    $lon2 = deg2rad($lon2);

                                    $a = 6378137; $b = 6356752.3142; $f = 1/298.257223563; // WGS-84 ellipsoid

                                    $L = $lon2 - $lon1;

                                    $U1 = atan((1-$f) * tan($lat1));
                                    $U2 = atan((1-$f) * tan($lat2));

                                    $sinU1 = sin($U1); $cosU1 = cos($U1);
                                    $sinU2 = sin($U2); $cosU2 = cos($U2);

                                    $lambda = $L; $lambdaP = 2 * M_PI;

                                    $iterLimit = 20;

                                    while (abs($lambda - $lambdaP) > 1e-12 && --$iterLimit > 0)
                                    {
                                        $sinLambda = sin($lambda);
                                        $cosLambda = cos($lambda);
                                        $sinSigma  = sqrt(($cosU2 * $sinLambda) * ($cosU2 * $sinLambda) +
                                                        ($cosU1 * $sinU2 - $sinU1 * $cosU2 * $cosLambda) *
                                                        ($cosU1 * $sinU2 - $sinU1 * $cosU2 * $cosLambda));

                                        if ($sinSigma == 0) return 0; // co-incident points

                                        $cosSigma   = $sinU1 * $sinU2 + $cosU1 * $cosU2 * $cosLambda;
                                        $sigma      = atan2($sinSigma, $cosSigma); // was atan2
                                        $alpha      = asin($cosU1 * $cosU2 * $sinLambda / $sinSigma);
                                        $cosSqAlpha = cos($alpha) * cos($alpha);
                                        $cos2SigmaM = $cosSigma - 2 * $sinU1 * $sinU2 / $cosSqAlpha;
                                        $C          = $f / 16 * $cosSqAlpha * (4 + $f * (4 - 3 * $cosSqAlpha));
                                        $lambdaP    = $lambda;
                                        $lambda     = $L + (1 - $C) * $f * sin($alpha) *
                                                    ($sigma + $C * $sinSigma * ($cos2SigmaM + $C * $cosSigma *
                                                    (-1 + 2 * $cos2SigmaM * $cos2SigmaM)));
                                    }
                                    if ($iterLimit == 0) return false; // formula failed to converge

                                    $uSq = $cosSqAlpha * ($a * $a - $b * $b) / ($b * $b);
                                    $A   = 1 + $uSq / 16384 * (4096 + $uSq * (-768 + $uSq * (320 - 175 * $uSq)));
                                    $B   = $uSq / 1024 * (256 + $uSq * (-128 + $uSq * (74 - 47 * $uSq)));

                                    $deltaSigma = $B * $sinSigma * ($cos2SigmaM + $B / 4 * ($cosSigma * (-1 + 2 * $cos2SigmaM * $cos2SigmaM) -
                                                $B / 6 * $cos2SigmaM * (-3 + 4 * $sinSigma * $sinSigma) * (-3 + 4 * $cos2SigmaM * $cos2SigmaM)));

                                    $s = $b * $A * ($sigma - $deltaSigma);

                                    $s = round($s, 3); // round to 1mm precision

                                    return $s;
                                }
                            ?>
                            <?php $__currentLoopData = $snapshot_sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $su): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($su->data()['uid']==$uid): ?>
                                    <tr>
                                        <td><?php echo e($no++); ?></td>
                                        <td><?php echo e($su->data()['date']); ?></td>
                                        <td><?php echo e($su->data()['start_time']); ?></td>
                                        <td><?php echo e($su->data()['end_time']); ?></td>
                                        <td>
                                            <?php
                                                $to_time = strtotime($su->data()['start_time']);
                                                $from_time = strtotime($su->data()['end_time']);
                                                $seconds =  round(abs($to_time - $from_time));
                                                echo secondsToTime($seconds);
                                            ?>
                                        </td>
                                        <td><?php echo e($su->data()['end_address']); ?></td>
                                        <td><?php echo e($su->data()['end_address']); ?></td>
                                        <td>
                                            <?php
                                            echo distVincenty($su->data()['start_lat'], $su->data()['start_long'], $su->data()['end_lat'], $su->data()['end_long']).'m'
                                            ?>
                                        </td>
                                        <td><?php echo e($su->data()['client']); ?></td>
                                        <td><?php echo e($su->data()['purpose']); ?></td>
                                        <td>
                                            <a href="<?php echo e(url('firebase-sessions/view/'.$su->data()['uid'].'/'.$su->data()['id'].'')); ?>"><button class="btn btn-success btn-sm"><i class="lnr lnr-eye"></i></button></a>
                                        </td>
                                        <td>
                                            <?php if(isset($su->data()['updated_at'])): ?>
                                                <?php echo e(date('Y-m-d | H:i:s',strtotime($su->data()['updated_at']))); ?>

                                            <?php endif; ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
<?php $__env->startPush('scripts'); ?>
    <script>
    $(document).ready(function() {
        $('#example').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],

            fixedHeader: {
            header: true,
            },
            "columnDefs": [
            {
                "targets": [ 5 ],
                "visible": false,
                "searchable": true
            },
            {
                "targets": [ 6 ],
                "visible": false,
                "searchable": true
            }
        ]
        });
    });
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.firebase', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>