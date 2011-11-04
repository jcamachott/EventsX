EventsX.panel.Home = function(config) {
    config = config || {};
    Ext.apply(config,{
        border: false
        ,baseCls: 'modx-formpanel'
        ,items: [{
            html: '<h2>'+_('eventsx')+'</h2>'
            ,border: false
            ,cls: 'modx-page-header'
        },{
            xtype: 'modx-tabs'
            ,bodyStyle: 'padding: 10px'
            ,defaults: { border: false ,autoHeight: true }
            ,items: [{
                title: _('eventsx.desc')
                ,border: false
                ,defaults: { autoHeight: true, border: false }
                ,items: [{
                    xtype: 'eventsx-grid-events'
                    ,preventRender: true
                }]
            }]
        }]
    });
    EventsX.panel.Home.superclass.constructor.call(this,config);
};
Ext.extend(EventsX.panel.Home,MODx.Panel);
Ext.reg('eventsx-panel-home',EventsX.panel.Home);
