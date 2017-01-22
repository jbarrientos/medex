<?php
use yii\helpers\Url;

$events = [];

//print_r($citas);

foreach($citas as $cita){
    
    $events[] = [
      'title'=>$cita->patient->getFullName() . '::'.$cita->getStatus(),
        'start'=>$cita->consultation_date . ' '.$cita->hour->name,
        //'end'=>$cita->consultation_date . ' '.$cita->getEndTime(),
        'allDay'=>false,
        //'color'=>sprintf('#%06X', mt_rand(0, 0xFFFFFF)),
        'color'=>($cita->status=='P' ? '#5C9BD4' : ($cita->status=='C' ? '#DA4453' : '#A9C643')),
        'url'=>Url::to(['consultation/view','id'=>$cita->id])
    ];
    
//    $events[] = [
//      'title'=>'Dummy',
//        'start'=>$cita->consultation_date,
//        'end'=>$cita->consultation_date,
//    ];
    
    //print_r($cita);
    
}
//print_r($events);


?>
<h3><?= '<i class="glyphicon glyphicon-calendar"></i> '.Yii::t('app','Consultations')
    .' '.Yii::$app->session['centerName']?></h3>
<?= \talma\widgets\FullCalendar::widget([
    'googleCalendar' => true,  // If the plugin displays a Google Calendar. Default false
    
    'loading' => Yii::t('app', 'Loading...'), // Text for loading alert. Default 'Loading...'
    
    'config' => [
        // put your options and callbacks here
        // see http://arshaw.com/fullcalendar/docs/
        //'lang' => 'pt-br', // optional, if empty get app language
        //...
        'nowIndicator'=>true,
        'titleFormat'=>'MMMM YYYY',
        'events'=>$events,
        //'defaultView'=>'month',
        //'defaultView'=>'agendaWeek',
        'header'=> [
            'left'=>'prev,next today myCustomButton',
            'center'=> 'title',
            'right'=> 'month,agendaWeek,agendaDay'
        ]
    ],
]); ?>