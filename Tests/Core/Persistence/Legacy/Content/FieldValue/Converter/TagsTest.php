<?php

namespace EzSystems\TagsBundle\Tests\Core\Persistence\Legacy\Content\FieldValue\Converter;

use eZ\Publish\SPI\Persistence\Content\FieldValue;
use eZ\Publish\Core\Persistence\Legacy\Content\StorageFieldValue;
use eZ\Publish\Core\Persistence\Legacy\Content\StorageFieldDefinition;
use eZ\Publish\SPI\Persistence\Content\Type\FieldDefinition as PersistenceFieldDefinition;
use EzSystems\TagsBundle\Core\Persistence\Legacy\Content\FieldValue\Converter\Tags as TagsConverter;
use PHPUnit_Framework_TestCase;

/**
 * Test case for Tags converter in Legacy storage
 */
class TagsTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tags converter
     *
     * @var \EzSystems\TagsBundle\Core\Persistence\Legacy\Content\FieldValue\Converter\Tags
     */
    protected $converter;

    protected function setUp()
    {
        parent::setUp();
        $this->converter = new TagsConverter();
    }

    /**
     * @group fieldType
     * @group eztags
     * @covers \EzSystems\TagsBundle\Core\Persistence\Legacy\Content\FieldValue\Converter\Tags::toStorageValue
     */
    public function testToStorageValue()
    {
        $value = new FieldValue();
        $value->data = array( "key1", "key2" );
        $value->sortKey = false;

        $storageFieldValue = new StorageFieldValue();

        $this->converter->toStorageValue( $value, $storageFieldValue );

        $this->assertNull( $storageFieldValue->dataText );
        $this->assertNull( $storageFieldValue->dataInt );
        $this->assertNull( $storageFieldValue->dataFloat );

        $this->assertEquals( 0, $storageFieldValue->sortKeyInt );
        $this->assertEquals( "", $storageFieldValue->sortKeyString );
    }

    /**
     * @group fieldType
     * @group eztags
     * @covers \EzSystems\TagsBundle\Core\Persistence\Legacy\Content\FieldValue\Converter\Tags::toFieldValue
     */
    public function testToFieldValue()
    {
        $storageFieldValue = new StorageFieldValue();
        $fieldValue = new FieldValue();

        $this->converter->toFieldValue( $storageFieldValue, $fieldValue );

        $this->assertSame( array(), $fieldValue->data );
        $this->assertNull( $fieldValue->sortKey );
    }

    /**
     * @group fieldType
     * @group eztags
     * @covers \EzSystems\TagsBundle\Core\Persistence\Legacy\Content\FieldValue\Converter\Tags::toStorageFieldDefinition
     */
    public function testToStorageFieldDefinition()
    {
        $this->converter->toStorageFieldDefinition( new PersistenceFieldDefinition(), new StorageFieldDefinition() );
    }

    /**
     * @group fieldType
     * @group eztags
     * @covers \EzSystems\TagsBundle\Core\Persistence\Legacy\Content\FieldValue\Converter\Tags::toFieldDefinition
     */
    public function testToFieldDefinition()
    {
        $this->converter->toFieldDefinition( new StorageFieldDefinition(), new PersistenceFieldDefinition() );
    }
}
