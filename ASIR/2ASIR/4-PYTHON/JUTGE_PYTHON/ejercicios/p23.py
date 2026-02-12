import sys

tokens = sys.stdin.read().split()

if len(tokens) >= 2:
    orig_a = int(tokens[0])
    orig_b = int(tokens[1])

    a = orig_a
    b = orig_b
    while b > 0:
        a, b = b, a % b

    gcd = a
    
    print(f"The gcd of {orig_a} and {orig_b} is {gcd}.")