Ext.onReady(function() {
    MODx.load({ xtype: 'eventsx-page-home'});
});

EventsX.page.Home = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        components: [{
            xtype: 'eventsx-panel-home'
            ,renderTo: 'eventsx-panel-home-div'
        }]
    });
    EventsX.page.Home.superclass.constructor.call(this,config);
};
Ext.extend(EventsX.page.Home,MODx.Component);
Ext.reg('eventsx-page-home',EventsX.page.Home);