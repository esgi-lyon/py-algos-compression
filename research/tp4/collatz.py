# Add tests module
import sys
import os
sys.path.append(os.path.abspath(__file__ + '/../../modules'))

from tests import run

def syracuse(start, query, sequence = []):
    if len(sequence) == 0:
        sequence.append(start)

    if start % 2 == 0:
        start = int(start / 2)
    else:
        start = int(start * 3 + 1)

    sequence.append(start)

    if query <= len(sequence):
        return sequence[query - 1]
    else:
        sequence = syracuse(start, query, sequence)

    return sequence

run(syracuse, [
    {'args': {'start': 14, 'query': 5}, 'result': 34},
    {'args': {'start': 14, 'query': 2}, 'result': 7},
    {'args': {'start': 14, 'query': 1}, 'result': 14},
])
