function autoCalcSetup(){
    $('form[name=ipcrf]').jAutoCalc('destroy');
    $('form[name=ipcrf] tr[name=ipcrf]').jAutoCalc({keyEventsFire: true, decimalPlaces: 2, emptyAsZero: true});
    $('form[name=ipcrf]').jAutoCalc({decimalPlaces: 2});
}
