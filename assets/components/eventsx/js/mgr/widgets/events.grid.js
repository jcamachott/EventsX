EventsX.grid.Events = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'eventsx-grid-events'
        ,url: EventsX.config.connectorUrl
        ,baseParams: {
            action: 'mgr/event/getlist'
        }
        ,fields: ['id', 'active', 'name', 'introtext', 'description', {name: 'startdate', type: 'date', dateFormat: 'Y-m-d'}, {name: 'enddate', type: 'date', dateFormat: 'Y-m-d'}, 'location', 'street', 'pc', 'city', 'region', 'country', 'website']
        ,paging: true
        ,border: false
        ,frame: false
        ,remoteSort: true
        ,anchor: '97%'
        ,autoExpandColumn: 'name'
        ,columns: [{
            header: _('id')
            ,dataIndex: 'id'
            ,sortable: true
            ,width: 1
        },{
            header: _('eventsx.event.active')
            ,dataIndex: 'active'
            ,width: 1
            ,renderer: function(value) {
                return "<input disabled='disabled' type='checkbox'" + (value ? "checked='checked'" : "") + " />";
            }
        },{
            header: _('eventsx.event.startdate')
            ,dataIndex: 'startdate'
            ,renderer:Ext.util.Format.dateRenderer(MODx.config.manager_date_format)
            ,width: 2
        },{
            header: _('eventsx.event.enddate')
            ,dataIndex: 'enddate'
            ,renderer:Ext.util.Format.dateRenderer(MODx.config.manager_date_format)
            ,width: 2
        },{
            header: _('eventsx.event.name')
            ,dataIndex: 'name'
            ,sortable: true
            ,width: 10
        }]
        ,tbar: [{
            text: _('eventsx.event.new')
            ,handler: this.createEvent
        }]
    });
    EventsX.grid.Events.superclass.constructor.call(this,config)
};
Ext.extend(EventsX.grid.Events,MODx.grid.Grid,{
    getMenu: function() {
        var m = [{
                text: _('eventsx.event.update')
                ,handler: this.updateEvent
            },{
                    text: _('eventsx.event.remove')
                    ,handler: this.removeEvent
            }
        ];
        this.addContextMenuItem(m);
        return true;
    }
    ,createEvent: function(btn,e) {
        this.EventWindow = MODx.load({
            xtype: 'eventsx-window-event'
            ,listeners: {
                'success': {fn:this.refresh,scope:this}
            }
        });
        this.EventWindow.show(e.target);
        this.EventWindow.setTitle(_('eventsx.event.new'));
        this.EventWindow.reset();
    }
    ,updateEvent: function(btn,e) {
        this.EventWindow = MODx.load({
            xtype: 'eventsx-window-event'
            ,listeners: {
                'success': {fn:this.refresh,scope:this}
            }
        });
        this.EventWindow.show(e.target);
        this.EventWindow.setTitle(_('eventsx.event.update'));
        //this.EventWindow.reset();
        this.EventWindow.setValues(this.menu.record);
        if (typeof Tiny != 'undefined') { MODx.loadRTE('eventdescription'); }
    }
    ,removeEvent: function() {
        MODx.msg.confirm({
            title: _('eventsx.event.remove')
            ,text: _('eventsx.event.remove.confirm')
            ,url: this.config.url
            ,params: {
                action: 'mgr/event/remove'
                ,id: this.menu.record.id
            }
            ,listeners: {
                'success': {fn:this.refresh,scope:this}
            }
        });
    }
});
Ext.reg('eventsx-grid-events',EventsX.grid.Events);

EventsX.window.Event = function(config) {
    config = config || {};
    this.ident = config.ident || Ext.id();
    Ext.applyIf(config,{
        title: _('eventsx.event.new')
        ,url: EventsX.config.connectorUrl
        ,autoHeight: true
        ,baseParams: {
            action: 'mgr/event/update'
        }
        ,width: 750
        ,closeAction: 'close'
        ,fields: [{
            xtype: 'modx-tabs'
            ,listeners: {
                'tabchange': function() {
                    this.syncSize();
                },
                scope: this
            }
            ,autoHeight: true
            ,deferredRender: false
            ,forceLayout: true
            ,width: '98%'
            ,borderStyle: 'padding: 10px 10px 10px 10px;'
            ,border: true
            ,defaults: {
                border: false
                ,labelWidth: 100
                ,autoHeight: true
                ,bodyStyle: 'padding: 5px 8px 5px 5px;'
                ,layout: 'form'
                ,deferredRender: false
                ,forceLayout: true
            }
            ,items: [{
                title: _('eventsx.event')
                ,items: [{
                        xtype: 'hidden'
                        ,name: 'id'
                    },{
                        xtype: 'xcheckbox'
                        ,fieldLabel: _('eventsx.event.active')
                        ,name: 'active'
                        ,inputValue: 1
                    },{
                        xtype: 'textfield'
                        ,fieldLabel: _('eventsx.event.name')
                        ,name: 'name'
                        ,width: 300
                        ,allowBlank: false
                    },{
                        xtype: 'textarea'
                        ,fieldLabel: _('eventsx.event.introtext')
                        ,name: 'introtext'
                        ,width: 300
                        ,allowBlank: true
                    },{
                        xtype: 'textarea'
                        ,id: 'eventdescription-'+this.ident
                        ,fieldLabel: _('eventsx.event.description')
                        ,name: 'description'
                        ,width: 300
                        ,allowBlank: true
                    },{
                        xtype: 'xdatefield'
                        ,fieldLabel: _('eventsx.event.startdate')
                        ,name: 'startdate'
                        ,allowBlank: false
                        ,format:  MODx.config.manager_date_format
                    },{
                        xtype: 'xdatefield'
                        ,fieldLabel: _('eventsx.event.enddate')
                        ,name: 'enddate'
                        ,allowBlank: false
                        ,format: MODx.config.manager_date_format
                    }
                ]
            },{
                title: _('eventsx.event.location')
                ,items: [{
                        xtype: 'textfield'
                        ,fieldLabel: _('eventsx.event.location')
                        ,name: 'location'
                        ,width: 300
                        ,allowBlank: true
                    },{
                        xtype: 'textfield'
                        ,fieldLabel: _('eventsx.event.location.street')
                        ,name: 'street'
                        ,width: 300
                        ,allowBlank: true
                    },{
                        xtype: 'textfield'
                        ,fieldLabel: _('eventsx.event.location.pc')
                        ,name: 'pc'
                        ,width: 300
                        ,allowBlank: true
                    },{
                        xtype: 'textfield'
                        ,fieldLabel: _('eventsx.event.location.city')
                        ,name: 'city'
                        ,width: 300
                        ,allowBlank: true
                    },{
                        xtype: 'textfield'
                        ,fieldLabel: _('eventsx.event.location.region')
                        ,name: 'region'
                        ,width: 300
                        ,allowBlank: true
                    },{
                        xtype: 'textfield'
                        ,fieldLabel: _('eventsx.event.location.country')
                        ,name: 'country'
                        ,width: 300
                        ,allowBlank: true
                    },{
                        xtype: 'textfield'
                        ,fieldLabel: _('eventsx.event.location.website')
                        ,name: 'website'
                        ,width: 300
                        ,allowBlank: true
                    }
                ]
            }]
        }]
    });
    EventsX.window.Event.superclass.constructor.call(this,config);
    this.on('activate',function() {
        if (typeof Tiny != 'undefined') { MODx.loadRTE('eventdescription-' + this.ident); }
    });
};
Ext.extend(EventsX.window.Event,MODx.Window);
Ext.reg('eventsx-window-event',EventsX.window.Event);