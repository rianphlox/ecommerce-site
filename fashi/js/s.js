const form = document.querySelector('#Login')
        form.addEventListener('submit', e => {
            e.preventDefault();
            fetch('y.php', {
                method: 'POST',
                body: new FormData(form)
            })
            .then(res => res.json())
            .then(data => {
                var notyf = new Notyf();
                if (data.msgClass == 'success') {

                    notyf.success({
                        message: data.msg,
                        duration: 4000,
                        position: {
                            x: 'right',
                            y: 'top'
                            }
                        })
                        setTimeout(() => window.location = './Shop', 2000)
                } else {
                    notyf.error({
                    message: data.msg,
                    duration: 4000,
                    position: {
                        x: 'right',
                        y: 'top'
                    }
                    })

                }
            })
        })



        // register
        const form = document.querySelector('#signUp')
        form.addEventListener('submit', e => {
            e.preventDefault();
            fetch('x.php', {
                method: 'POST',
                body: new FormData(form)
            })
            .then(res => res.json())
            .then(data => {
                var notyf = new Notyf();
                if (data.msgClass == 'success') {
                    notyf.success({
                        message: data.msg,
                        duration: 4000,
                        position: {
                            x: 'right',
                            y: 'top'
                            }
                        })
                    setTimeout(() => window.location = './Login', 2000)
                } else {
                    notyf.error({
                    message: data.msg,
                    duration: 4000,
                    position: {
                        x: 'right',
                        y: 'top'
                    }
                    })

                }
            })

        })