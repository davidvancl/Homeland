'use strict';

module.exports = class ConsoleWriter {

    printMessage(message){
        console.log(this.getDateFormat() + message);
    }

    getDateFormat(){
        let date_ob = new Date();
        return "[ " + ("0" + date_ob.getDate()).slice(-2) +
               "." + ("0" + (date_ob.getMonth() + 1)).slice(-2) +
               "." + date_ob.getFullYear() +
               " " + date_ob.getHours() +
               ":" + date_ob.getMinutes() +
               ":" + date_ob.getSeconds() + " ] ";
    }
}