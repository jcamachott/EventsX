EventsX.grid.Events = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'eventsx-grid-events'
        ,url: EventsX.config.connectorUrl
        ,baseParams: {
            action: 'mgr/event/getlist'
        }
        ,fields: ['id', 'active', 'name', 'description', {name: 'startdate', type: 'date', dateFormat: 'Y-m-d'}, {name: 'enddate', type: 'date', dateFormat: 'Y-m-d'}]
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
            ,width: 10
        },{
            header: _('eventsx.event.active')
            ,dataIndex: 'active'
            ,width: 20
            ,renderer: function(value) {
                return "<input disabled='disabled' type='checkbox'" + (value ? "checked='checked'" : "") + " />";
            }
        },{
            header: _('eventsx.event.startdate')
            ,dataIndex: 'startdate'
            ,renderer:Ext.util.Format.dateRenderer(MODx.config.manager_date_format)
        },{
            header: _('eventsx.event.enddate')
            ,dataIndex: 'enddate'
            ,renderer:Ext.util.Format.dateRenderer(MODx.config.manager_date_format)
        },{
            header: _('eventsx.event.name')
            ,dataIndex: 'name'
            ,sortable: true
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
                text: _('eventsx.event.remove')
                ,handler: this.removeEvent
            },{
                text: _('eventsx.event.update')
                ,handler: this.updateEvent
            }
        ];
        this.addContextMenuItem(m);
        return true;
    }
    ,createEvent: function(btn,e) {
        if (!this.EventWindow) {
            this.EventWindow = MODx.load({
                xtype: 'eventsx-window-event'
                ,listeners: {
                    'success': {fn:this.refresh,scope:this}
                }
            });
        }
        this.EventWindow.show(e.target);
        this.EventWindow.setTitle(_('eventsx.events.new'));
        Ext.getCmp('eventsx-window-event-form-tabs').setActiveTab(0);
        Ext.getCmp('eventsx-window-event-form').form.reset();
    }
    ,updateEvent: function(btn,e) {
        if (!this.EventWindow) {
            this.EventWindow = MODx.load({
                xtype: 'eventsx-window-event'
                ,listeners: {
                    'success': {fn:this.refresh,scope:this}
                }
            });
        }
        this.EventWindow.show(e.target);
        this.EventWindow.setTitle(_('eventsx.event.update'));
        Ext.getCmp('eventsx-window-event-form-tabs').setActiveTab(0);
        Ext.getCmp('eventsx-window-event-form').form.reset();
        Ext.getCmp('eventsx-window-event-form').form.setValues(this.menu.record);
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
    Ext.applyIf(config,{
        id: 'eventsx-window-event'
        ,title: _('eventsx.event.new')
        ,url: EventsX.config.connectorUrl
        ,keys: []
        ,width: 600
        ,buttons: [{
            process: 'submit',
            text: _('save'),
            handler: function() {
                frm = Ext.getCmp('eventsx-window-event-form').form;

                if (frm.isValid()) {
                    frm.submit({
                        waitMsg: _('saving'),
                        success: function(form,action) {
                            Ext.getCmp('eventsx-window-event').hide();
                            Ext.getCmp('eventsx-grid-events').refresh();
                        },
                        failure: function(form,action) {
                            Ext.MessageBox.alert(_('error'),_('eventsx.error.undefined'));
                        }
                    })
                }
                else {
                    Ext.MessageBox.alert(_('error'),_('eventsx.error.missingrequired'));
                }
            }
        }]
        ,items: [{
            xtype: 'form'
            ,url: EventsX.config.connectorUrl
            ,baseParams: {
                action: 'mgr/event/update'
            }
            ,fileUpload: true
            ,forceLayout: true
            ,id: 'eventsx-window-event-form'
            ,items: [{
                xtype: 'modx-tabs'
                ,id: 'eventsx-window-event-form-tabs'
                ,defaults: {
                    layout: 'form'
                    ,labelWidth: 150
                    ,autoHeight: true
                    ,hideMode: 'offsets'
                    ,bodyStyle: 'padding: 15px'
                    ,border: false
                    ,xtype: 'modx-panel'
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
                            ,fieldLabel: _('eventsx.event.description')
                            ,name: 'description'
                            ,width: 300
                            ,allowBlank: false
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
                }]
            }]
        }]
    });
    EventsX.window.Event.superclass.constructor.call(this,config);
};
Ext.extend(EventsX.window.Event,MODx.Window);
Ext.reg('eventsx-window-event',EventsX.window.Event);