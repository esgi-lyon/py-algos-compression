# Test a function with a result set
def run(func, cases):
    # Start tests
    i = 0
    count = len(cases)
    passed = 0
    failed =  0

    for case in cases:
        i = i + 1
        str_assert = "test %s with args %s" % (i, case["args"])
        result = func(**case["args"])

        if result == case["result"]:
            print(str_assert, ": PASSED")
            print('===================')
            passed += 1
        else:
            print('Have : %s' % result, 'Expected : %s' % case["result"])
            print(str_assert, ': FAILED')
            print('===================')
            failed += 1

    print("FAILED %d" % failed)
    print("PASSED %d" % passed)
    print('===================')
