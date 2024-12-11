/*
	# Compilazione:
		cc -mpreferred-stack-boundary=3 -ggdb -m32 p15_functions_and_the_stack.c -o function
	
	# Debugging:
		gdb function
		
	# Disassembla main:
		disas main
	
	# Disassemble function:
		disas function

*/

#include <stdio.h>

void function(int a, int b){
	int array[5];
}

main(){
	function(1, 2);
	
	printf("This is where the return address points");
}
