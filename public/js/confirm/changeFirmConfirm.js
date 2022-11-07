$("#complexConfirm").confirm({
    title:"Потвърждение за промяна!",
    text: "Сигурни ли сте, че искате да направите промените на тази фирма?",
    confirm: function(button) {
        $("#form")[0].submit();
    },
    confirmButton: "Да. Сигурен съм.",
    cancelButton: "Не. Откажи!"
});
