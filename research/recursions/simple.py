#!/usr/bin/env python

import sys
sys.setrecursionlimit(1000)

# Desk
desk = [[0] * 3] * 3
print(desk)

# recurse
i = 0
depth = 3


def recurseFunc():
    global i
    global depth
    if depth <= i:
        return

    print(desk)
    i += 1
    recurseFunc()


recurseFunc()

# factorial
def coeff(n, k):
    if k == 0 or k == n:
        return 1
    return coeff(n - 1, k - 1) + coeff(n - 1, k)


n, k = (49, 5)

print(coeff(n, k))

# TP
# deux fn => façon itérative et recursive de la puissance n de x

# Ex
def factorielle_iterative(n):
		res = 1
		for i in range(2, n + 1):
			res *= i
		return res


# 1 : forme iterative x^n

def puissance(x, n):
		# 2 * 3
		res = 1
		for i in range(0, n):
			res *= x

		return res

print(puissance(2, 3))

# def recursive
def puissance_rec(x, n):
		if n == 0:
			return 1

		else:
			return x*puissance_rec(x, n -1)
