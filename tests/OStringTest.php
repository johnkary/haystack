<?php
namespace OPHP\Test;

use OPHP\OString;

class OStringTest extends \PHPUnit_Framework_TestCase
{
    /** @var \OPHP\Ostring */
    protected $aString;

    protected function setUp()
    {
        $this->aString= new OString("foobar");
    }

    public function testCreateEmptyString()
    {
        $emptyString = new OString();
        $this->assertEmpty($emptyString);

        $emptyString = new OString("");
        $this->assertEmpty($emptyString);

        $emptyLookingString = new OString(" ");
        $this->assertNotEmpty($emptyLookingString);
    }

    /**
     * @dataProvider stringContainsProvider
     *
     * @param $checkString
     * @param $expectedBool
     */
    public function testTypesOfStringInFoobar($checkString, $expectedBool)
    {
        $var = $this->aString->contains($checkString);
        $expectedBool ? $this->assertTrue($var) : $this->assertFalse($var);
    }

    public function stringContainsProvider()
    {
        return [
            ["checkString" => "oob", "expected" => true],
            ["checkString" => "baz", "expected" => false],
            ["checkString" => new OString('oob'), "expected" => true],
            ["checkString" => new OString('baz'), "expected" => false],
            ["checkString" => 42, "expected" => false],

        ];
    }

    /**
     * @dataProvider stringLocateProvider()
     *
     * @param $checkString
     * @param $expected
     */
    public function testLocateTypesOfStringInFoobar($checkString, $expected)
    {
        $var = $this->aString->locate($checkString);
        $this->assertEquals($expected, $var);
    }

    public function stringLocateProvider()
    {
        return [
            ["checkString" => "oob", "expected" => 1],
            ["checkString" => "baz", "expected" => -1],
            ["checkString" => 42, "expected" => -1],
            ["checkString" => new OString('oob'), "expected" => 1],
            ["checkString" => new OString('baz'), "expected" => -1],
            ["checkString" => new OString(42), "expected" => -1],

        ];
    }

    /**
     * @dataProvider stringAppendProvider()
     *
     * @param $babyString
     * @param $expected
     */
    public function testTypesOfStringAppendToFoobar($babyString, $expected)
    {
        $newString = $this->aString->append($babyString);

        $this->assertEquals(sprintf("%s", $expected), sprintf("%s", $newString));
    }

    public function stringAppendProvider()
    {
        return [
            ["babyString" => "baz", "expected" => "foobarbaz"],
            ["babyString" => new OString('baz'), "expected" => "foobarbaz"],
            ["babyString" => 5, "expected" => "foobar5"],
        ];
    }

    public function testGetFirstPartOfTypesOfStringUsingSlice()
    {
        $substr1 = "foob";
        $substr2 = new OString("foob");

        $this->assertEquals($substr1, $this->aString->slice(0, 4));
        $this->assertEquals($substr2, $this->aString->slice(0, 4));

    }

    public function testGetLastPartOfTypesOfStringUsingSlice()
    {
        $substr1 = "obar";
        $substr2 = new OString("obar");

        $this->assertEquals($substr1, $this->aString->slice(-4));
        $this->assertEquals($substr2, $this->aString->slice(-4));
    }

    /**
     * @dataProvider middlePartOfStringProvider
     *
     * @param $start
     * @param $finish
     * @param $expected
     */
    public function testGetMiddlePartOfTypesOfStringUsingSlice($start, $finish, $expected)
    {
        $substr1 = $expected;
        $substr2 = new OString($expected);

        $this->assertEquals($substr1, $this->aString->slice($start, $finish));
        $this->assertEquals($substr2, $this->aString->slice($start, $finish));
    }

    public function middlePartOfStringProvider()
    {
        return [
            ["start" => 2, "finish" => -2, "expected" => "ob"],
            ["start" => -4, "finish" => -2, "expected" => "ob"],
            ["start" => 2, "finish" => 2, "expected" => "ob"],
            ["start" => 2, "finish" => null, "expected" => "obar"],
        ];
    }

    /**
     * @dataProvider stringInsertProvider()
     *
     * @param $babyString
     * @param $location
     * @param $expected
     */
    public function testTypesOfStringInsert($babyString, $location, $expected)
    {
        $newString = $this->aString->insert($babyString, $location);

        $this->assertEquals(sprintf("%s", $expected), sprintf("%s", $newString));
    }

    public function stringInsertProvider()
    {
        return [
            ["babyString" => "baz", "location" => "1", "expected" => "fbazoobar"],
            ["babyString" => "baz", "location" => "-1", "expected" => "foobabazr"],
            ["babyString" => "baz", "location" => null, "expected" => "foobarbaz"],
            ["babyString" => 0.0, "location" => 3, "expected" => "foo0bar"],
            ["babyString" => new OString("baz"), "location" => "1", "expected" => "fbazoobar"],
            ["babyString" => new OString("baz"), "location" => "-1", "expected" => "foobabazr"],
            ["babyString" => new OString("baz"), "location" => null, "expected" => "foobarbaz"],
            ["babyString" => new OString("baz"), "location" => null, "expected" => "foobarbaz"],
            ["babyString" => new OString(0), "location" => 3, "expected" => "foo0bar"],
        ];
    }

    public function testTypesOfStringRemove()
    {
        $newString = $this->aString->remove("o");
        $this->assertEquals(new OString("fobar"), $newString);
    }

    /**
     * @expectedException \ErrorException
     */
    public function testNonScalarTypeCannotBeAddedToFoobar()
    {
        $newString = $this->aString->append(new \DateTime());
    }

    public function testIteratorNext()
    {
        $this->aString->next();
        $this->assertEquals("o", $this->aString->current());
    }

    public function testIteratorValid()
    {
        $this->aString->next();
        $this->aString->next();
        $this->aString->next();
        $this->aString->next();
        $this->aString->next();
        $this->assertTrue($this->aString->valid());
        $this->aString->next();
        $this->assertFalse($this->aString->valid());
    }

    public function testIteratorRewind()
    {
        $this->aString->next(); // "o"
        $this->aString->next(); // "o"
        $this->aString->next(); // 'b"

        $this->aString->rewind(); // back to "f"
        $this->assertEquals("f", $this->aString->current());
    }

    public function testIteratorKey()
    {
        $this->aString->next(); // "o"
        $this->aString->next(); // "o"
        $this->aString->next(); // 'b"

        $this->assertEquals(3, $this->aString->key());
    }

    public function testArrayStyleCount()
    {
        $this->assertEquals(6, $this->aString->count());
    }

    public function testArrayStyleOffsetExists()
    {
        $this->assertTrue(isset($this->aString[3]));
        $this->assertFalse(isset($this->aString[30]));
    }

    public function testArrayStyleOffsetGet()
    {
        $this->assertEquals("b", $this->aString[3]);
    }

    public function testArrayStyleOffsetSet()
    {
        $this->aString[0] = "b";
        $this->assertEquals(new OString("boobar"), $this->aString);
    }

    public function testArrayStyleOffsetUnset()
    {
        unset($this->aString[3]);
        $this->assertEquals(chr(0x00), $this->aString[3]); // binary null
    }

    public function testArrayStyleAccess()
    {
        $this->assertEquals("o", $this->aString[1]);
    }

    public function testStringMap()
    {
        $capitalize = function ($word) {
            return strtoupper($word);
        };

        $newString = $this->aString->map($capitalize);

        $this->assertEquals("FOOBAR", $newString);
    }

    public function testStringWalk()
    {
        $capitalize = function ($letter, $key) {
            return $this->aString[$key] = strtoupper($letter);
        };

        $this->aString->walk($capitalize);

        $this->assertEquals("FOOBAR", $this->aString->toString());
    }

    public function testStringFilter()
    {
        $removeVowels = function ($letter) {
            $vowels = new OString("aeiou");
            return !$vowels->contains($letter);
        };

        $removeOdd = function ($key) {
            return $key % 2;
        };

        $alpha = new OString('abcdefghijklmnopqrstuvwxyz');
        $evenAlpha = $alpha->filter($removeOdd, OString::USE_KEY);

        $thing_both = function ($value, $key) use ($evenAlpha) {
            if ($evenAlpha->contains($value)) {
                return true;
            } else {
                return $key % 2;
            }
        };

        $strangeString = $this->aString->insert(0, 3);
        $default = $strangeString->filter();
        $this->assertEquals("foobar", $default->toString());

        $consonants = $this->aString->filter($removeVowels);
        $this->assertEquals("fbr", $consonants->toString());

        $flag = OString::USE_KEY;
        $even = $this->aString->filter($removeOdd, $flag);
        $this->assertEquals("obr", $even->toString());

        $flag = OString::USE_BOTH;
        $funky = $this->aString->filter($thing_both, $flag);
        $this->assertEquals("fobr", $funky->toString());
    }

    public function testStringHead()
    {
        $this->assertEquals("f", $this->aString->head()->toString());

        $emptyString = new OString();
        $this->assertEmpty(sprintf($emptyString->head()));
    }

    public function testStringTail()
    {
        $this->assertEquals("oobar", $this->aString->tail()->toString());

        $emptyString = new OString();
        $this->assertEmpty(sprintf($emptyString->tail()));
    }
}
