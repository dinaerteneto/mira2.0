//Config
requirejs.config({
    "baseUrl": "/js/",
    "paths": {
        'jquery': 'http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min',
        'jquery.ui': 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min',
        'config': 'app.config',
        'jquery.touch': 'plugin/jquery-touch/jquery.ui.touch-punch.min',
        'bootstrap': 'bootstrap/bootstrap.min',
        'notification': 'notification/SmartNotification.min',
        'smartwidgets': 'smartwidgets/jarvis.widget.min',
        'easy.pie.chart': 'plugin/easy-pie-chart/jquery.easy-pie-chart.min',
        'sparkline': 'plugin/sparkline/jquery.sparkline.min',
        'jquery.validate': 'plugin/jquery-validate/jquery.validate.min',
        'jquery.masked.input': 'plugin/masked-input/jquery.maskedinput.min',
        'select2': 'plugin/select2/select2.min',
        'bootstrap.slider': 'plugin/bootstrap-slider/bootstrap-slider.min',
        'jquery.mb.browser': 'plugin/msie-fix/jquery.mb.browser.min',
        'fastclick': 'plugin/fastclick/fastclick.min',
        'init': 'app.min',
        'voicecommand': 'speech/voicecommand.min',
        
        'jquery.maskedinput': 'libs/jquery.maskedinput-1.3.1.min',
        'jquery.maskmoney': 'libs/jquery.maskMoney.0.2',        
        
        'form': 'custom/form'
        
    },
    shim: {
        'jquery.ui': {deps: ['jquery']},
        'config': {deps: ['jquery']},
        'jquery.touch': {deps: ['jquery']},
        'bootstrap': {deps: ['jquery']},
        'notification': {deps: ['jquery']},
        'smartwidgets': {deps: ['jquery']},
        'easy.pie.chart': {deps: ['jquery']},
        'sparkline': {deps: ['jquery']},
        'jquery.validate': {deps: ['jquery']},
        'jquery.masked.input': {deps: ['jquery']},
        'select2': {deps: ['jquery']},
        'bootstrap.slider': {deps: ['jquery']},
        'jquery.mb.browser': {deps: ['jquery']},
        'fastclick': {deps: ['jquery']},
        'init': {deps: ['jquery', 'easy.pie.chart']},
        
        'jquery.masketinput': {deps: ['jquery']},
        'jquery.maskmoney': {deps: ['jquery']},        
        'form': {deps: ['jquery', 'jquery.maskedinput', 'jquery.maskmoney']}
        
        //'voicecommand': {deps: ['jquery']}
    }
});

define(
        [
            'jquery',
            'jquery.ui',
            'config',
            'jquery.touch',
            'bootstrap',
            'notification',
            'smartwidgets',
            'easy.pie.chart',
            'sparkline',
            'jquery.validate',
            'jquery.masked.input',
            'select2',
            'bootstrap.slider',
            'jquery.mb.browser',
            'fastclick',
            'init',
            'form'
                    //'voicecommand'
        ], function ($) {
    pageSetUp();
});
