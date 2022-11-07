$("#complexConfirm").confirm({
    title:"Потвърждение за изтриване!",
    text: "Сигурни ли сте, че искате да изтриете фирмата? " +
    "Щебъдат изтрити всички Констативни протоколи за нея!",
    confirm: function(button) {
        $("#form")[0].submit();
    },
    confirmButton: "Да. Сигурен съм.",
    cancelButton: "Не. Откажи!"
});
