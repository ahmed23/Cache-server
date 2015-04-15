package main

import (
	"io"
	"log"
	"net"
	"bytes"
	"bufio"
	"strings"
)

type jsonData struct {
	importantStuff string
	otherStuff     int
}

var cache [maxEntries]jsonData

func main() {
	go listen(somePort) // only once cliend - demo
}

func listen(port int) {
	in, err := net.listen("tcp", ":"+port)
	if err != nil {
		//error
	}
	for {
		con, err := in.Accept()
		if err != nil {
			// error
		}
		channel := make(chan string)
		go request_handler(conn, channel)
		go send_data(conn, channel)
	}
}

func handleCommand(cmd string) {
	// parse command and do switch(){case"ins": addItem(item); break; case"blabla"...}
}

func addItem(object string){
	data jsonData = string.convertToJsonData
	if(object is not too big){
		cache[x] = data
	}
}

func removeItem(string key){

}

func findItem(key string){

}