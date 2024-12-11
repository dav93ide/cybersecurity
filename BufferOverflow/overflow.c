/**
  Inserendo come input una stringa con piu` di 30 caratteri l'INDIRIZZO DI RITORNO (EIP) verra` sovrascritto con i caratteri della stringa causando il crash del programma.
  E` una vulnerabilita` BUFFER OVERFLOW che puo` essere sfruttata per eseguire uno SHELLCODE.
**/

void return_input(void){
  char array[30];

  gets(array);
  printf("%s\n", array);
}

int main(){
  return_input();
  return 0;
}
