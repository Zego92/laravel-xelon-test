import { useEffect, useState } from 'react';
import logo from './logo.svg';
import './App.css';
import { socket } from "@/socket";
import {ConnectionManager} from "@/components/connection-manager";
import {Events} from "@/components/events";
import {ConnectionState} from "@/components/connection-state";
import {Form} from "@/components/form";
import Pusher from "pusher-js";

function App() {
  const [isConnected, setIsConnected] = useState(socket.connected);
  const [fooEvents, setFooEvents] = useState<string[]>([]);

  // useEffect(() => {
  //   function onConnect() {
  //     setIsConnected(true);
  //   }
  //
  //   function onDisconnect() {
  //     setIsConnected(false);
  //   }
  //
  //   function onFooEvent(value: string) {
  //     setFooEvents((previous) => [...previous, value]);
  //   }
  //
  //   socket.on('connect', onConnect);
  //   socket.on('disconnect', onDisconnect);
  //   socket.on('foo', onFooEvent);
  //
  //   return () => {
  //     socket.off('connect', onConnect);
  //     socket.off('disconnect', onDisconnect);
  //     socket.off('foo', onFooEvent);
  //   };
  // }, []);
    useEffect(() => {
        Pusher.logToConsole = true;

        var pusher = new Pusher('251645e418a98a7bf10c', {
            cluster: 'eu'
        });

        var channel = pusher.subscribe('currency');
        channel.bind('currency-event', function(data: any) {
            alert(JSON.stringify(data));
        });
    }, [])

  return (
    <div className="App">
      <ConnectionState isConnected={ isConnected } />
      <Events events={ fooEvents } />
      <ConnectionManager />
      <Form />
      {/*<header className="App-header">*/}
      {/*  <img src={logo} className="App-logo" alt="logo" />*/}
      {/*  <p>*/}
      {/*    Edit <code>src/App.tsx</code> and save to reload.*/}
      {/*  </p>*/}
      {/*  <a*/}
      {/*    className="App-link"*/}
      {/*    href="https://reactjs.org"*/}
      {/*    target="_blank"*/}
      {/*    rel="noopener noreferrer"*/}
      {/*  >*/}
      {/*    Learn React*/}
      {/*  </a>*/}
      {/*</header>*/}
    </div>
  );
}

export default App;
