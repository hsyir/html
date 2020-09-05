<?php

namespace Hsy\Html;

use Hsy\Html\Exceptions\ComponentNotFound;

class

Html
{
    private $component_items = [];
    private $variables = [];
    private $component_parameters = [];
    private $must_render = true;
    private $active_component = null;

    public function __construct()
    {
        $this->variables = config('html.variables');
        $this->component_items = config('html.components');
    }

    public function __call($methodName, $args)
    {
        $firstArg = $args[0] ?? null;

        if (!$this->active_component) {
            $tryResult = $this->trySetActiveComponent($methodName, $firstArg);
            if ($tryResult === true)
                return $this;
            throw new ComponentNotFound($tryResult);
        }

        try {
            if ($this->trySetVariable($methodName, $firstArg))
                return $this;
            $this->tryAddAsAttribute($methodName, $firstArg);
        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $this;
    }

    public function when($must_render)
    {
        $this->must_render = $must_render;
        return $this;
    }

    private function getComponentFullPath($component)
    {
        return config("html.views_path") . $component;
    }

    private function getActiveComponentFullPath()
    {
        $fullPath = $this->getComponentFullPath($this->active_component);
        if (view()->exists($fullPath))
            return $fullPath;

        throw new \Exception("Component file not found: '$fullPath'");
    }

    private function resetComponentParameters()
    {
        $this->must_render = true;
        $this->active_component = null;
        $this->component_parameters = [];
    }

    private function trySetActiveComponent($componentName, $nameAttribute = null)
    {
        if (!in_array($componentName, $this->component_items))
            return "Component '$componentName' not defined";

        $this->active_component = $componentName;
        try {
            $this->getActiveComponentFullPath();
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        if ($nameAttribute)
            $this->component_parameters['name'] = $nameAttribute;

        return true;
    }

    private function trySetVariable($parameter, $value)
    {
        if (!in_array($parameter, $this->variables))
            return false;

        $this->component_parameters[$parameter] = $value;
        return true;
    }

    private function tryAddAsAttribute($attribute, $value)
    {
        $this->component_parameters['attributes'][$attribute] = $value;
    }

    public function __toString()
    {
        if (!$this->must_render) {
            $this->resetComponentParameters();
            return "";
        }

        try {
            $componentViewFilePath = $this->getActiveComponentFullPath();
            $html = view($componentViewFilePath, $this->component_parameters)->render();
        } catch (\Exception $exception) {
            echo view("html::error.errorMessage",
                [
                    "component" => $this->active_component,
                    "message" => $exception->getMessage()
                ]
            );
            die;
        }

        $this->resetComponentParameters();

        echo $html;
        return "";
    }

}
