$("#complexConfirm").confirm({
    title:"Потвърждение за заключване!",
    text: "Сигурни ли сте, че искате да заключите удостоверението?",
    confirm: function(button) {
        $("#form")[0].submit();
    },
    confirmButton: "Да. Сигурен съм.",
    cancelButton: "Не. Откажи!"
});

$("#unlockConfirm").confirm({
    title:"Потвърждение за отключване!",
    text: "Администратор. Сигурни ли сте, че искате да отключите удостоверението?",
    confirm: function(button) {
        $("#form")[0].submit();
    },
    confirmButton: "Да. Сигурен съм.",
    cancelButton: "Не. Откажи!"
});

