<?php
/**
 * Contains the SupportFunctionsTest class.
 *
 * @copyright   Copyright (c) 2017 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2017-06-12
 *
 */


namespace Konekt\Concord\Tests\Unit;

use Konekt\Concord\Conventions\ConcordDefault;
use PHPUnit\Framework\TestCase as PHPUnitBaseTestCase;

class SupportFunctionsTest extends PHPUnitBaseTestCase
{

    public function testFunctionsExist()
    {
        $this->assertTrue(function_exists('classpath_to_slug'), 'classpath_to_slug function should exist');
        $this->assertTrue(function_exists('slug_to_classpath'), 'slug_to_classpath function should exist');
        $this->assertTrue(function_exists('concord_module_id'), 'concord_module_id function should exist');
    }

    /**
     * @dataProvider slugProvider
     */
    public function testSlugToClasspath($classPath, $slug)
    {
        $this->assertEquals($classPath, slug_to_classpath($slug));
    }

    /**
     * @dataProvider classpathProvider
     */
    public function testClasspathToSlug($classPath, $slug)
    {
        $this->assertEquals($slug, classpath_to_slug($classPath));
    }

    /**
     * @dataProvider moduleIdProvider
     */
    public function testConcordModuleId($class, $id)
    {
        $this->assertEquals($id, concord_module_id($class, new ConcordDefault()));
    }

    public function classpathProvider()
    {
        return [
            ['\App\Services\BamBamService', 'app.services.bam_bam_service'],
            ['App\Services\BamBamService', 'app.services.bam_bam_service'],
            ['BamBamService', 'bam_bam_service'],
            ['\BamBamService', 'bam_bam_service'],
            ['App\SerViCes\BamBamService', 'app.ser_vi_ces.bam_bam_service'],
            ['App\SerViCes\BamBamService\\', 'app.ser_vi_ces.bam_bam_service'],
            ['Vendor\WTF\Models\Blah\\', 'vendor.w_t_f.models.blah'],
        ];
    }

    public function slugProvider()
    {
        return [
            ['App\Services\BamBamService', 'app.services.bam_bam_service'],
            ['App\SerViCes\BamBamService', 'app.ser_vi_ces.bam_bam_service'],
            ['BamBamService', 'bam_bam_service'],
            ['Vendor\WTF\Models\Blah', 'vendor.w_t_f.models.blah'],
        ];
    }

    public function moduleIdProvider()
    {
        return [
            ['Konekt\Acl\Providers\ModuleServiceProvider', 'konekt.acl'],
            ['\Konekt\Acl\Providers\ModuleServiceProvider', 'konekt.acl'],
            ['VenDor\WTF\Providers\ModuleServiceProvider', 'ven_dor.w_t_f'],
            ['App\Modules\Billing\Providers\ModuleServiceProvider', 'billing'],
            ['\App\Modules\Order\Providers\ModuleServiceProvider', 'order'],
            ['\App\Modules\coyote\Providers\ModuleServiceProvider', 'coyote'],
            ['App\Modules\WordPress\Providers\ModuleServiceProvider', 'word_press']
        ];

    }

}