var EventsX = function(config) {
    config = config || {};
    EventsX.superclass.constructor.call(this,config);
};
Ext.extend(EventsX,Ext.Component,{
    page:{},window:{},grid:{},tree:{},panel:{},combo:{},config: {}
});
Ext.reg('eventsx',EventsX);

EventsX = new EventsX();