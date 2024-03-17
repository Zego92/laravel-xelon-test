import './bootstrap';

const channel = Echo.channel('public.currencies');
channel
    .subscribed(() => {
    console.log('subscribed')
    })
    .listen('.currencies', (event) => {
        console.log(event);
    });

