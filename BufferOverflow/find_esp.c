// Necessario disabilitare randomizzazione registri dello stack con istruzione shell:
// sudo bash -c 'echo 0 > /proc/sys/kernel/randomize_va_space'

#include <stdlib.h>
#include <stdio.h>

unsigned int find_start(void){
  __asm__("mov %esp, %eax");
}

int main(){
  printf("0x%x\n", find_start());
}
