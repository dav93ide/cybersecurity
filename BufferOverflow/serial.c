/**
  Disassemblando vado a trovare l'indirizzo del metodo "do_valid_stuff()", quindi genero una stringa di input sufficientemente lunga da sovrascrivere
  EIP ed inserisco l'indirizzo del metodo "do_valid_stuff()" all'interno di questa stringa in modo tale da sovrascrivere EIP con tale indirizzo.
  In questo modo il controllo del seriale viene saltato.
**/
#include <stdlib.h>
#include <stdio.h>
#include <string.h>

int valid_serial(char *psz){
  size_t len = strlen(psz);
  unsigned total = 0;
  size_t i;

  if(len < 10){
    return 0;
  }

  for(i = 0; i < len; i++){
    if((psz[i] < '0') || (psz[i] > 'z' )){
      return 0;
    }
    total += psz[i];
  }

  if(total % 853 == 83){
    return 1;
  }

  return 0;
}

int validate_serial(){
  char serial[24];

  fscanf(stdin, "%s", serial);
  if(valid_serial(serial)){
    return 1;
  } else {
    return 0;
  }
}
int do_valid_stuff(){
  printf("The serial number is valid!\n");
  exit(0);
}

int do_invalid_stuff(){
  printf("Invalid serial number!\nExiting\n");
  exit(1);
}

int main(int argc, char *argv[]){
  if(validate_serial()){
    do_valid_stuff();
  } else {
    do_invalid_stuff();
  }
  return 0;
}
