﻿"use strict";
var Planets = function(parameters) {

    this.frame      = 0;
    this.resources  = {};
    this.c          = Helpers.get("worldCanvas");
    this.cx         = this.c.getContext("2d");

    this.width      = this.c.width;
    this.height     = this.c.height;

    this.center     = {
        x: this.width/2,
        y: this.width/2
    }

    this._flags     = {
        "_resources_loaded": false
    },
    this.data       = {}
    this.elements   = []
};

Planets.prototype.getGlobalCenter = function() {
    return this.center;
}

Planets.prototype.getStartTimestamp = function() {
    return this.startTimestamp;
}

Planets.prototype.pushResource = function(name, url) {
    this.resources[name] = url
}

Planets.prototype.draw = function(timestamp) {
    //setTimeout(function(){self.draw(new Date())}, 100);
    var self = this;
    self.frame++;

    self.cx.clearRect(0, 0, this.width, this.height);
    for(var a in self.elements) {
        if(self.elements.hasOwnProperty(a)) {
            var drawData = this.elements[a].draw(timestamp);

            self.cx.save();
            self.cx.translate((this.width-drawData.width)/2, (this.height-drawData.height)/2);
            self.cx.drawImage(drawData, self.elements[a].getX(), self.elements[a].getY());
            self.cx.restore();
        }
    }

    requestAnimFrame(function(){self.draw(new Date());});
}

Planets.prototype.loadResources = function(cb) {
    var self = this;
    self.data.loadedResourcesCount = 0;
    self.data.resourcesCount = Helpers.objLength(self.resources);
    for(var resource in self.resources) {
        if(self.resources.hasOwnProperty(resource)) {
            var tempImg     = new Image();
            tempImg.onload  = function() {
                self.data.loadedResourcesCount++;
                if(self.data.loadedResourcesCount == self.data.resourcesCount) {
                    self.startTimestamp = new Date();
                    self._flags['_resources_loaded'] = true;
                    cb();
                }
            }
            tempImg.src = self.resources[resource];
            self.resources[resource] = tempImg;
        }
    }
}

Planets.prototype.listen = function() {
    var self = this;

    window.addEventListener("mousedown", function(evt){
        var e = {
            x: evt.x,
            y: evt.y
        }
        if(!e.x) {
            e.x = evt.clientX;
        }
        e.x = e.x + window.scrollX;
        if(!e.y) {
            e.y = evt.clientY;
        }
        e.y = e.y + window.scrollY;
        self.handleMouseEvent("mousedown", e);
    }, false);

    window.addEventListener("mousemove", function(evt){
        var e = {
            x: evt.x,
            y: evt.y
        }
        if(!e.x) {
            e.x = evt.clientX;
        }
        e.x = e.x + window.scrollX;
        if(!e.y) {
            e.y = evt.clientY;
        }
        e.y = e.y + window.scrollY;
        self.handleMouseEvent("mousemove", e);
    }, false);

    window.addEventListener("mouseup", function(evt){
        var e = {
            x: evt.x,
            y: evt.y
        }
        if(!e.x) {
            e.x = evt.clientX;
        }
        e.x = e.x + window.scrollX;
        if(!e.y) {
            e.y = evt.clientY;
        }
        e.y = e.y + window.scrollY;
        self.handleMouseEvent("mouseup", e);
    }, false);
}

Planets.prototype.handleMouseEvent = function(type, evt) {
    for (var n = this.elements.length - 1; n >= 0; n--) {
        var element = this.elements[n];
        if(typeof element.handleEvent == "function") {
            element.handleEvent(type, evt);
        }
    }
}

Planets.prototype.run = function(cb) {
    var self = this;
    self.loadResources(function(){
        cb.call(window);
        self.draw(new Date());
    });
}