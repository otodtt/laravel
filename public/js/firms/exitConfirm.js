$("#complexConfirm").confirm({
    title:"Потвърждение!",
    text: "Сигурни ли сте, че няма промени във фирмата?",
    confirm: function(button) {
        window.location =($("#complexConfirm").attr("href"));
    },
    confirmButton: "Да. Продължи.",
    cancelButton: "Не. Откажи!"
});
