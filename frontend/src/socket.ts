// Modules
import { io, Socket, Manager } from 'socket.io-client';

const url = `${process.env.REACT_APP_WS_BASE_URL}:${process.env.REACT_APP_WS_BASE_PORT}`;
// export const socket = io({
//     withCredentials: false,
//     path: process.env.REACT_APP_WS_BASE_URL,
//     port: process.env.REACT_APP_WS_BASE_PORT,
//     transports: ['websocket']
// });

export const socket = io(process.env.REACT_APP_WS_BASE_URL as string, {
    path: wsApiPath(),
    withCredentials: false,
    transports: ['websocket'],
    reconnectionDelay: 2000,
    rememberUpgrade: true,
});

function wsApiUrl() {
    let apiUrl: string | URL = process.env.REACT_APP_WS_BASE_URL || '';
    let isHttps;
    try {
        apiUrl = new URL(apiUrl);
        isHttps = apiUrl.protocol === 'https:';
    } catch {
        isHttps = false;
    }

    if (apiUrl instanceof URL) {
        const wsProtocol = isHttps ? 'wss' : 'ws';
        const originUrl = apiUrl.origin;
        return originUrl.replace(/https?/, wsProtocol);
    }

    return apiUrl;
}

socket.emit('ssdlsdl')

function wsApiPath() {
    return '/';
}
// export const socket = io({
//     path: 'http://xelon.test',
//     port: '6001',
//     autoConnect: true,
//     reconnection: true,
//     withCredentials: false,
//     addTrailingSlash: false,
//     autoUnref: false,
//     transports: ['websocket'],
//     host: 'xelon.test',
//     hostname: 'xelon',
// });
// console.log({socket, con});
