import sys
import os
sys.path.append(os.path.abspath(__file__ + '/../../modules'))

from tests import run

# nb parfaits
def perfect_nb(borne):
    res = []
    if borne < 6:
        print("Error: Perfect numbers start at 6")
        return None

    for i in range (1, borne + 1):
        somme = 0

        for j in range(1, int(i / 2) + 1):
            if i % j == 0:
                somme += j

        if i == somme:
            res.append(i)

    return res

# tests case
test_cases = [
    {"args": {'borne': 9000}, "result": [6, 28, 496, 8128]},
    {"args": {'borne': 3}, "result": None},
    {"args": {'borne': 500}, "result": [6, 28, 496]},
]

run(perfect_nb, test_cases)
