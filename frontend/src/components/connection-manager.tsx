import React, {FC} from 'react';
import {socket} from "@/socket";

export const ConnectionManager: FC = (): JSX.Element => {
    function connect() {
        console.log('ssaass')
        socket.connect();
    }

    function disconnect() {
        socket.disconnect();
    }
    return (
        <>
            <button onClick={ connect }>Connect</button>
            <button onClick={ disconnect }>Disconnect</button>
        </>
    );
};
