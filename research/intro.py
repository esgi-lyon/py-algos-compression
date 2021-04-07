#!/usr/bin/env python
# ======
# titre
# role
# entrée
# sortie
# (optionel)
# Saisie
# initialisation
# Affichage
# ======
enablePrompts = False

if(enablePrompts):
    n = int(eval(input("bit compare :")))

    if (not (n & 1)):
        print('pair')
    else:
        print('impair')

    print('\nFor')
    for v in range(1, n, 2):
        print('z', v)

    x = eval(input("\nwhile :"))
    while n + 1 <=x:
        n+=1

    print("\nranges :", n)
    # nested
    for i in range(1, 11):
        print("table de", i)
        for j in range(1, 11):
            print("\t", j, "*", i, "=", j*i)

print('\ntuple')
TupleEx = (2.718, 2.14)
print(TupleEx)

print('\nlist')
listEx = []
listEx.append(1)
print(listEx)

print('\nlist sort')
# [expression for x in sequence if conditionnelle]
t = (11, 22, 33)


def calculMini(x, y):
	if (x == y): raise ArithmeticError('%s is equal to %s' % (x, y))
	return x if x < y else y;

try:
	toCompare1 = (1, 2)
	print("Comparison 1", toCompare1, calculMini(*toCompare1))
	toCompare2 = (1, 1)
	print("Comparison 2: ", end="")
	print(toCompare2, calculMini(*toCompare2))
except ArithmeticError as err:
	print(err)

